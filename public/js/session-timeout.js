var SessionTimeoutDemo = function () {

    var initDemo = function () {
        $.sessionTimeout({
            title: 'Session Timeout Notification',
            message: 'Your session is about to expire.',
            keepAliveUrl: '',
            redirUrl: base_url+'/logout',
            logoutUrl: base_url+'/logout',
            warnAfter: 3000, //warn after 5 seconds
            redirAfter: 33000, //redirect after 10 secons,
            ignoreUserActivity: true,
            countdownMessage: 'Redirecting in {timer} seconds.',
            countdownBar: true
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initDemo();
        }
    };

}();

var idleTime = 0; 
jQuery(document).ready(function() {    
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute
    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {        
        idleTime = 0;
    });    
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 19) { // 20 minutes
        window.location = base_url+"/logout";
        // SessionTimeoutDemo.init();
    }
}