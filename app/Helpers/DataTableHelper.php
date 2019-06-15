<?php // DataTable Helper

namespace App\Helpers;

class DataTableHelper
{
    public static function list_vendor($verified_only)
    {
    	$items = \DB::table('companies as c')
                    ->leftJoin('users as u', 'u.id', '=' , 'c.user_id')
                    ->select('c.id as id', 'c.name as name', 'c.address as address', 'c.type_id as type_id', 'u.state as state', \DB::raw('IFNULL(u.penalty_start, "") as penalty_start'), \DB::raw('IFNULL(u.penalty_end, "") as penalty_end'), \DB::raw('IFNULL(u.registration_time, "") as registration_time'), \DB::raw('IFNULL(u.created_at, "") as created_time'), \DB::raw('IFNULL(u.updated_at, "") as updated_time'), 'c.business as business', 'c.created_at as created_at')
                    ->where('u.role_level', 1);

        if($verified_only == true) {
            $items = $items->where('u.state', 1);
        } else {
            $items = $items->where('u.state', '<>', 1);
        }

        return $items->get();
    }

    public static function list_vendor_temp()
    {
    	$items = \DB::table('companies as c')
                    ->leftJoin('users as u', 'u.id', '=' , 'c.user_id')
                    ->select('c.id as id', 'c.name as name', 'c.address as address', 'c.type_id as type_id', 'u.state as state', \DB::raw('IFNULL(u.penalty_start, "") as penalty_start'), \DB::raw('IFNULL(u.penalty_end, "") as penalty_end'), \DB::raw('IFNULL(u.registration_time, "") as registration_time'), \DB::raw('IFNULL(u.created_at, "") as created_time'), \DB::raw('IFNULL(u.updated_at, "") as updated_time'), 'c.business as business', 'c.created_at as created_at')
                    ->where('u.role_level', 1)
                    ->where('u.state', 2);

        return $items->get();
    }

    public static function list_vendor_blacklisted()
    {
        $items = \DB::table('companies as c')
                    ->leftJoin('users as u', 'u.id', '=' , 'c.user_id')
                    ->select('c.id as id', 'c.name as name', 'u.taxpayer_number as taxpayer_number', 'c.address as address', 'c.phone as phone', 'c.type_id as type_id', 'u.state as state', \DB::raw('IFNULL(u.penalty_start, "") as penalty_start'), \DB::raw('IFNULL(u.penalty_end, "") as penalty_end'), \DB::raw('IFNULL(u.registration_time, "") as registration_time'), \DB::raw('IFNULL(u.created_at, "") as created_time'), \DB::raw('IFNULL(u.updated_at, "") as updated_time'), 'c.business as business', 'c.created_at as created_at')
                    ->where('u.state', 6);

        return $items->get();
    }

    public static function list_all_procurement()
    {
        $items = \DB::table('pre_procurements as p')
                    ->leftJoin('schedules as s', 'p.id', '=' , 's.procurement_id')
                    ->select(   'p.id as id', 
                                'p.procurement_id as procurement_id', 
                                'p.title as title',
                                'p.state as state', 
                                'p.stage as stage', 
                                \DB::raw('concat_ws("|", p.state, p.start_date) as state_date'), 
                                \DB::raw('concat_ws(" : ", if(p.listed, "Pengadaan Aktif", if(p.proposed, "Drafting","Perencanaan")), date_format(p.updated_at,"%d %M %Y")) as status'),
                                'p.start_date as start_date', 
                                \DB::raw('IFNULL(s.a_start, "") as schedule'))
                    ->where('p.procurement_id','<>',null);

        return $items->get();
    }

    public static function list_public_procurement()
    {
        $items = \DB::table('pre_procurements as p')
                    ->leftJoin('schedules as s', 'p.id', '=' , 's.procurement_id')
                    ->select('p.id as id', 'p.procurement_id as procurement_id', 'p.title as title', 'p.procurement_method as method', 'p.stage as stage', \DB::raw('IFNULL(s.a_start, "") as schedule'))
                    ->where('p.listed', true)
                    ->where('p.procurement_method', 1)->orWhere('p.procurement_method', 2);

        return $items->get();
    }

    public static function list_proposed_procurement($role_level = 0, $id = 0)
    {
        $items = \DB::table('pre_procurements as p')
                    ->leftJoin('users as u', 'u.id', '=' , 'p.user_id')
                    ->leftJoin('user_units as n', 'n.id', '=' , 'u.unit_id')
                    ->select('p.id as id', 'p.title as title' ,'n.name as work_unit', 'p.procurement_method as procurement_method', 'p.amount as amount', 'p.stage as stage')
                    ->where('p.proposed', true)
                    ->where('p.listed', false)
                    ->where('p.worked', false);
        if($role_level == 2) {
            $items = $items->where('p.user_id', $id);
        } else if($role_level == 4) {
            $items = $items->where('u.unit_id', $id);
        } else if($role_level == 5) {
            $division_ids = \DB::table('users as u')
                                ->leftJoin('user_units as n', 'n.id', '=' , 'u.unit_id')
                                ->leftJoin('user_divisions as v', 'v.id', '=' , 'n.division_id')
                                ->where('u.id', $id)
                                ->pluck('v.id')
                                ->toArray();
            $unit_ids       = \DB::table('user_units as n')
                                ->leftJoin('user_divisions as v', 'v.id', '=' , 'n.division_id')
                                ->whereIn('v.id', $division_ids)
                                ->pluck('n.id')
                                ->toArray();
            $items = $items->whereIn('u.unit_id', $unit_ids);
        } else if($role_level == 6) {
            $department_ids = \DB::table('users as u')
                                ->leftJoin('user_units as n', 'n.id', '=' , 'u.unit_id')
                                ->leftJoin('user_divisions as v', 'v.id', '=' , 'n.division_id')
                                ->leftJoin('user_departments as d', 'd.id', '=' , 'v.department_id')
                                ->where('u.id', $id)
                                ->pluck('d.id')
                                ->toArray();
            $unit_ids       = \DB::table('user_units as n')
                                ->leftJoin('user_divisions as v', 'v.id', '=' , 'n.division_id')
                                ->leftJoin('user_departments as d', 'd.id', '=' , 'v.department_id')
                                ->whereIn('d.id', $department_ids)
                                ->pluck('n.id')
                                ->toArray();
            $items = $items->whereIn('u.unit_id', $unit_ids);
        }

        return $items->get();
    }

    public static function list_listed_procurement()
    {
        $items = \DB::table('pre_procurements as p')
                    ->leftJoin('users as u', 'u.id', '=' , 'p.user_id')
                    ->leftJoin('user_units as n', 'n.id', '=' , 'u.unit_id')
                    ->select('p.id as id', 'p.title as title' ,'n.name as work_unit', 'p.procurement_method as procurement_method', 'p.amount as amount', 'p.stage as stage')
                    ->where('p.listed', true)
                    ->where('p.worked', false);

        return $items->get();
    }

    public static function list_listed_procurement_vendor($company_id)
    {
        // print_r($company_id);die();
        $items = \DB::table('pre_procurements as p')
                    ->leftJoin('users as u', 'u.id', '=' , 'p.user_id')
                    ->leftJoin('user_units as n', 'n.id', '=' , 'u.unit_id')
                    ->leftJoin('enrollments as e', 'p.id', '=' , 'e.procurement_id')
                    ->select('p.id as id', 'p.title as title' ,'n.name as work_unit', 'p.procurement_method as procurement_method', 'p.amount as amount', 'p.stage as stage')
                    ->where('p.listed', true)
                    ->where('p.worked', false)
                    ->where('e.vendor_id', $company_id);

        return $items->get();
    }

    public static function list_my_procurement($company_id)
    {
        $items = \DB::table('pre_procurements as p')
                    ->leftJoin('schedules as s', 'p.id', '=' , 's.procurement_id')
                    ->leftJoin('enrollments as e', 'p.id', '=' , 'e.procurement_id')
                    ->select('p.id as id', 'p.procurement_id as procurement_id', 'p.title as title', 'p.procurement_method as method', 'p.stage as stage', \DB::raw('IFNULL(s.a_start, "") as schedule'))
                    ->where('e.vendor_id', $company_id);

        return $items->get();
    }

    //request it mti
    public static function list_user_planning(){
        $items =\DB::table('users as a')
                    ->leftjoin('user_units as b', 'b.id', '=', 'a.unit_id')
                    ->select('a.id as id', 'a.name as name', 'a.nip as nip', 'a.email as email', 'b.name as unit_name', 'a.created_at as created_at')
                    ->where('a.role_level', 2);

        return $items->get();
    }

    public static function user_data(){
        $items =\DB::table('users as a')
                    ->leftjoin('user_units as b', 'b.id', '=', 'a.unit_id')
                    ->leftjoin('role_level as c', 'c.id', '=', 'a.role_level')
                    ->select('a.id as id', 'a.name as name', 'a.nip as nip', 'a.email as email', 'b.name as unit_name', 'a.created_at as created_at', 'c.keterangan as role_ket')
                    ->where('a.role_level','<>', 1);
        return $items->get();
    }

    public static function list_vendor_status(){
        $items =\DB::table('users as a')
                    ->select('a.id as id', 'a.pin as pin', 'a.name as name', 'a.nip as nip', 
                                \DB::raw('case when a.taxpayer_number not like "%-%" then concat(substring(a.taxpayer_number,1,2), ".", substring(a.taxpayer_number,3,3), ".", 
                                substring(a.taxpayer_number,6,3),".", substring(a.taxpayer_number,9,1),"-", substring(a.taxpayer_number,10,3), ".", substring(a.taxpayer_number,13)) 
                                else a.taxpayer_number end as taxpayer_number'),
                                'a.email as email', 
                                \DB::raw('case when state = 0 then "Request PIN" when state = 1 then "Terverifikasi" when state = 2 then "Sedang Diverifikasi" 
                                when state = 6 then "Blocklist Vendor" when state = 4 then "Menunggu Kelengkapan" end as status'),
                                'a.rating as rating')
                    ->where('a.role_level', 1);

        return $items->get();
    }

    // Add By Dandy Firmansyah 29 04 2019

    public static function list_vendor_excel($status)
    {
        $items = \DB::table('companies as c')
                    ->select('c.id as id', 'c.name as name', 'c.type_id as type_id', 'c.address as address', 
                    \DB::raw('CONCAT(cc.name,"(",cc.job_title,")") as contact_person'),
                    'cc.email as email', 'c.phone as telepon_kantor', 'c.fax as fax_kantor', 'cc.handphone as hp', 
                    'creg.registration_number as no_tdp','creg.expired_date as tgl_tdp_expired', 
                    'siup.document_number as no_siup', 'siup.expired_date as tgl_siup_expired',
                    'tax.taxpayer_number as no_npwp','tax.release_date as tgl_npwp',
                    'deed.number as no_akta_pendirian', 'deed.released as tgl_akta_pendirian', 'kumham.document_number as no_sk_kemenkumham_pendirian',
                    'deed.renewal_number as no_akta_perubahan','deed.renewaled as tgl_akta_perubahan', 'kumham.document_number_perubahan as no_sk_kemenkumham_perubahan',
                    'u.state as state', 
                    \DB::raw('IFNULL(u.penalty_start, "") as penalty_start'), \DB::raw('IFNULL(u.penalty_end, "") as penalty_end'), 
                    \DB::raw('IFNULL(u.registration_time, "") as registration_time'), \DB::raw('IFNULL(u.created_at, "") as created_time'), 
                    \DB::raw('IFNULL(u.updated_at, "") as updated_time'), 'c.business as business', 'c.created_at as created_at')
                    ->leftJoin('users as u', 'u.id', '=' , 'c.user_id')
                    ->leftjoin(\DB::raw('(SELECT ccs.* 
                                        FROM company_contacts ccs 
                                        GROUP BY ccs.company_id
                                        ORDER BY ccs.id DESC) cc'),'cc.company_id','=','c.id')
                    ->leftjoin(\DB::raw('(SELECT cr.* 
                                        FROM company_registrations cr 
                                        GROUP BY cr.company_id
                                        ORDER BY cr.id DESC) creg'),'creg.company_id','=','c.id')
                    ->leftjoin(\DB::raw('(SELECT siups.* 
                                        FROM permit_s_i_u_ps siups 
                                        GROUP BY siups.company_id
                                        ORDER BY siups.id DESC) siup'),'siup.company_id','=','c.id')
                    ->leftjoin(\DB::raw('(SELECT taxes.* 
                                        FROM company_taxes taxes 
                                        GROUP BY taxes.company_id
                                        ORDER BY taxes.id DESC) tax'),'tax.company_id','=','c.id')
                    ->leftjoin(\DB::raw('(SELECT deeds.* 
                                        FROM company_deeds deeds 
                                        GROUP BY deeds.company_id
                                        ORDER BY deeds.id DESC) deed'),'deed.company_id','=','c.id')
                    ->leftjoin(\DB::raw('(SELECT kumhams.* 
                                        FROM permit_sk_kemenkumham kumhams 
                                        GROUP BY kumhams.company_id
                                        ORDER BY kumhams.id DESC) kumham'),'kumham.company_id','=','c.id');

        if($status == 'baru' || $status == 'aktif') {
            $items = $items->where('u.role_level', 1);
        }

        if($status == 'aktif') {
            $items = $items->where('u.state', 1);
        } else if ($status == 'baru') {
            $items = $items->where('u.state', 2);
        } else {
            $items = $items->where('u.state', 6);
        }
        
        return $items->get();
    }

    // End Add By Dandy Firmansyah 29 04 2019
}
