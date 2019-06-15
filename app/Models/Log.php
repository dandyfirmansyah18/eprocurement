<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'tl_logs';

    protected $fillable = [
							'user_id',
							'session_id',
							'request_method',
							'log_url',
							'request_payload',
							'log_task',
							'client_ip_address',
							'client_http_agent'
						];
	
	protected $primaryKey = 'log_id';
					
	public $timestamps = false;
}
