<?php
   
    /*
        NOTE: Reuse these functions !!
        | Or e modify (implement code optimization standards)
        ;

        Pag balik-balik gani ang code sa kada controller, 
        ibutang nalang siya diri as a function para less 
        lines of code.
    */
    
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;

    use App\Models\User;

    /**
     * Formats lastname
     * @param  $arr user info
     * @return String
     * @param
     *     formatName(["firstnam" => "Philipp Andrew", "lastname" => "Redondo", "middleinitial" => "R"])
     **/
    function formatName($arr) 
    { return $arr->lastname . ", " . $arr->firstname . " " . $arr->middleinitial; }



    
    /**
     * Checks if request has required parameter
     * @param  Request $request request
     * @param Array $array array of required parameters
     * @return boolean
     * @example
     *     hasNull(request()->all(),["param0", "param1", "param2"])
     **/
    function hasNull(Request $request, Array $arr) {
        foreach ($arr as $ar)
            if(!$request->has($ar))
                return true;
        return false;
    }

    /**
     * Truncates text
     * @param Int $num number|money|count
     * @return String
     * @example
     *     countTruncate(1500);
     *     # 1.5K
     **/ 
    function countTruncate(Int $num)
    {
        if ($num > 1000)
            return number_format(($num / 1000), 1) . 'k';
        else if ($num > 1000000)
            return number_format(($num / 1000000), 1) . 'M';
        else if ($num > 1000000000)
            return number_format(($num / 1000000000), 1) . 'B';
        return $num;
    }

?>

