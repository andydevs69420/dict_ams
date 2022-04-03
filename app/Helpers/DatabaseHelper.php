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
    use App\Models\User;

    /**
     * 
     * Check if user has an access to a route
     * @param int uid user's id
     * @param Array valid_access list of vaid access levels
     * @return bool
     * 
     */
    function isValidAccess(int $uid, Array $valid_access)
    { return in_array($uid,$valid_access); }

    /**
     * 
     * Get's userinfo by id
     * @param int uid user's id
     * @return JSON 
     * 
     */
    function getUserInfoById(int $uid)
    {
        return json_decode(
            json_encode(
                DB::table('users')
                ->select(
                    'users.id', 
                    'users.firstname', 
                    'users.lastname',
                    'users.middleinitial',
                    'users.username',
                    'users.email',
                    'designations.id AS designation_id',
                    'designations.designation AS designation_name',
                    'accesslevels.id AS accesslevel_id',
                    'accesslevels.accesslevel AS accesslevel_name',
                )
                ->join('designations', 'users.designation', '=', 'designations.id')
                ->join('accesslevels', 'users.accesslevel', '=', 'accesslevels.id')
                ->where('users.id', '=', $uid)->first(), 
                true
            ), 
            true
        );
    }
?>

