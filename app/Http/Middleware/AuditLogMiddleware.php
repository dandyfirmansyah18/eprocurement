<?php 
namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Closure, Auth, Session;
use App\User, App\Log;

class AuditLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $LOG_URL = implode($request->segments(), '/');
        $USER_ID = (Auth::check()) ? Auth::user()->id : NULL;
        $SESSION_ID = (Auth::check()) ? Session::getId() : NULL;
        $REQUEST_METHOD = $request->method();
        $REQUEST_PAYLOAD = json_encode($request->all(), TRUE);
        $LOG_TASK = NULL;
        $CLIENT_IP_ADDRESS = $request->ip();
        $CLIENT_HTTP_AGENT = $request->header('User-Agent');

        // dd($LOG_URL);

        if($LOG_URL != 'postlogin')
        {
            Log::create([
                "user_id" => $USER_ID,
                "session_id" => $SESSION_ID,
                "request_method" => $REQUEST_METHOD,
                "log_url" => $LOG_URL,
                "request_payload" => $REQUEST_PAYLOAD,
                "log_task" => $LOG_TASK,
                "client_ip_address" => $CLIENT_IP_ADDRESS,
                "client_http_agent" => $CLIENT_HTTP_AGENT,
            ]);
        }
        
        return $next($request);
    }
}