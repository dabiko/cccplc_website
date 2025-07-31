<?php
$ErrorCallback = "HandleRuntimeError";
$ExceptionCallback = "HandleException";
$FatalCallback = "HandleFatalError";

$EnableReporting = true;
$ErrorLevel = E_ALL;

function InitializeErrors()
{
    if($GLOBALS["EnableReporting"])
    {
        error_reporting($GLOBALS["ErrorLevel"]);

        if( isset($GLOBALS["ErrorCallback"]) && strlen($GLOBALS["ErrorCallback"]) > 0 )
        {
            set_error_handler($GLOBALS["ErrorCallback"]);

            // Prevent the PHP engine from displaying runtime errors on its own
            ini_set('display_errors',false);
        }
        else
            ini_set('display_errors',true);

        if( isset($GLOBALS["FatalCallback"]) && strlen($GLOBALS["FatalCallback"]) > 0 )
        {
            register_shutdown_function($GLOBALS["FatalCallback"]);

            // Prevent the PHP engine from displaying fatal errors on its own
            ini_set('display_startup_errors',false);
        }
        else
            ini_set('display_startup_errors',true);

        if( isset($GLOBALS['ExceptionCallback']) && strlen($GLOBALS['ExceptionCallback']) > 0 )
            set_exception_handler($GLOBALS["ExceptionCallback"]);
    }
    else
    {
        ini_set('display_errors',0);
        ini_set('display_startup_errors',0);
        error_reporting(0);
    }
}

function HandleRuntimeError($ErrorLevel,$ErrorMessage,$ErrorFile=null,$ErrorLine=null,$ErrorContext=null)
{
    if( isset($GLOBALS['ErrorHandler']))
    {
        //  Pass errors up to the global ErrorHandler to be later inserted into
        // final output at the appropriate time.
        $GLOBALS['ErrorHandler']->AppendError($ErrorLevel,"Runtime Error: " . $ErrorMessage,$ErrorFile,$ErrorLine,$ErrorContext);

        return true;
    }
    else
    {
        PrintError($ErrorLevel,$ErrorMessage,$ErrorFile,$ErrorLine,$ErrorContext);
        return true;
    }
}

function HandleException($Exception)
{
    if( isset($GLOBALS['ErrorCallback']))
    {
        // Parse and pass exceptions up to the standard error callback.
        $GLOBALS['ErrorCallback']($Exception->getCode(), "Exception: " . $Exception->getMessage(), $Exception->getFile(), $Exception->getLine(), $Exception->getTrace());

        return true;
    }
    else
    {       
        PrintError($Exception->getCode(), "Exception: " . $Exception->getMessage(), $Exception->getFile(), $Exception->getLine(), $Exception->getTrace());
        return true;
    }
}

function HandleFatalError()
{
    $Error = error_get_last();

    // Unset Error Type and Message implies a proper shutdown.
    if( !isset($Error['type']) && !isset($Error['message']))
        exit();
    else if( isset($GLOBALS['ErrorCallback']))
    {
        // Pass fatal errors up to the standard error callback.
        $GLOBALS["ErrorCallback"]($Error['type'], "Fatal Error: " . $Error['message'],$Error['file'],$Error['line']);

        return null;
    }
    else
    {
        PrintError($Error['type'], "Fatal Error: " . $Error['message'],$Error['file'],$Error['line']);
        return null;
    }
}

// In the event that our 'ErrorHandler' class is in fact the generator of the error,
// we need a plain-Jane method that will still deliver the message.
function PrintError($ErrorLevel,$ErrorMessage,$ErrorFile=null,$ErrorLine=null,$ErrorContext=null)
{
    if( class_exists("ErrorHandler"))
        $ErrorTypeString = ErrorHandler::ErrorTypeString($ErrorLevel);
    else
        $ErrorTypeString = "$ErrorLevel";

    if( isset($ErrorContext) && !is_array($ErrorContext) && strlen($ErrorContext) > 0 )
        $ErrorContext = str_replace("#", "<br/>\r\n#", $ErrorContext);

    $ReturnValue = "";
    $ReturnValue .= $ErrorTypeString;

    $ReturnValue .= $ErrorTypeString;

    if( isset($ErrorFile) && strlen($ErrorFile) > 0 )
        $ReturnValue .= $ErrorFile;

    if( isset($ErrorLine) && strlen($ErrorLine) > 0 )
        $ReturnValue .= $ErrorLine;

    if( isset($ErrorContext) && is_array($ErrorContext))
        $ReturnValue .= var_export($ErrorContext,true) ;
    else if( isset($ErrorContext) && strlen($ErrorContext) > 0 )
        $ReturnValue .= $ErrorContext;

    $ReturnValue .=  str_replace("\r\n","<br/>\r\n",$ErrorMessage);


    echo ($ReturnValue);
}

class ErrorHandler
{   
    public function AppendError($ErrorLevel,$ErrorMessage,$ErrorFile=null,$ErrorLine=null,$ErrorContext=null)
    {
        // Perhaps evaluate the error level and respond accordingly
        //
        // In the event that this actually gets used, something that might 
        // determine if you're in a production environment or not, or that 
        // determines if you're an admin or not - or something - could belong here.
        // Redirects or response messages accordingly.
        $ErrorTypeString = ErrorHandler::ErrorTypeString($ErrorLevel);

        if( isset($ErrorContext) && !is_array($ErrorContext) && strlen($ErrorContext) > 0 )
            $ErrorContext = str_replace("#", "<br/>\r\n#", $ErrorContext);

        $ReturnValue = "";
        $ReturnValue .= $ErrorTypeString;

        $ReturnValue .= $ErrorTypeString;

        if( isset($ErrorFile) && strlen($ErrorFile) > 0 )
            $ReturnValue .= $ErrorFile;

        if( isset($ErrorLine) && strlen($ErrorLine) > 0 )
            $ReturnValue .= $ErrorFile;

        if( isset($ErrorContext) && is_array($ErrorContext))
            $ReturnValue .= var_export($ErrorContext,true);
        else if( isset($ErrorContext) && strlen($ErrorContext) > 0 )
            $ReturnValue .= $ErrorContext;

        $ReturnValue .=  str_replace("\r\n","<br/>\r\n",$ErrorMessage);

       

        echo($ReturnValue);
    }

    public static function ErrorTypeString($ErrorType)
    {
        $ReturnValue = "";

        switch( $ErrorType )
        {
            default:
                $ReturnValue = "E_UNSPECIFIED_ERROR"; 
                break;
            case E_ERROR: // 1 //
                $ReturnValue = 'E_ERROR'; 
                break;
            case E_WARNING: // 2 //
                $ReturnValue = 'E_WARNING'; 
                break;
            case E_PARSE: // 4 //
                $ReturnValue = 'E_PARSE'; 
                break;
            case E_NOTICE: // 8 //
                $ReturnValue = 'E_NOTICE'; 
                break;
            case E_CORE_ERROR: // 16 //
                $ReturnValue = 'E_CORE_ERROR'; 
                break;
            case E_CORE_WARNING: // 32 //
                $ReturnValue = 'E_CORE_WARNING'; 
                break;
            case E_COMPILE_ERROR: // 64 //
                $ReturnValue = 'E_COMPILE_ERROR'; 
                break;
            case E_CORE_WARNING: // 128 //
                $ReturnValue = 'E_COMPILE_WARNING'; 
                break;
            case E_USER_ERROR: // 256 //
                $ReturnValue = 'E_USER_ERROR'; 
                break;
            case E_USER_WARNING: // 512 //
                $ReturnValue = 'E_USER_WARNING'; 
                break;
            case E_USER_NOTICE: // 1024 //
                $ReturnValue = 'E_USER_NOTICE'; 
                break;
            case E_STRICT: // 2048 //
                $ReturnValue = 'E_STRICT';
                break;
            case E_RECOVERABLE_ERROR: // 4096 //
                $ReturnValue = 'E_RECOVERABLE_ERROR';
                break;
            case E_DEPRECATED: // 8192 //
                $ReturnValue = 'E_DEPRECATED'; 
                break;
            case E_USER_DEPRECATED: // 16384 //
                $ReturnValue = 'E_USER_DEPRECATED'; 
                break;
        }

        return $ReturnValue;
    }
}

$ErrorHandler = new ErrorHandler();

?>