<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

use Auth;
use App\Models\User;
use App\Models\UserProfileImages;
use App\Models\UserVerificationDetails;

class CTRLR_7_UserController extends Controller
{
    /**
     * Users -> index
     * @param Request $request request
     * @return View
     * @example
     *     Only "admin" has access to this page
     *          Accesslevel table
     *             14 := admin
     **/
    public function users(Request $request)
    {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if  (!Auth::check())
            return redirect()->to("/login");

        #============================
        # Only admin can view user  =
        # list                      =
        #============================
        if (!Auth::user()->isAdmin())
            return redirect()->to("/dashboard");

        return view("app.users.users");
    }

    /* user subdir ----> */

                /**
                 * View user profile -> user/userid
                 **/
                public function user_profile(String $userid)
                {
                    #============================
                    # Redirect to login if not  =
                    # login or expired.         =
                    #============================
                    if  (!Auth::check())
                        return redirect()->to("/login");

                    $user_id = $userid;

                    #=================================================
                    # Decrypt hashed user id.                        =
                    # If invalid hashed value, redirect to dashboard =
                    #=================================================
                    $decrypt = null;
                    try
                    { $decrypt = (int) Crypt::decrypt($userid); }
                    catch (\Illuminate\Contracts\Encryption\DecryptException $e)
                    { return redirect()->to("/dashboard"); }

                    #=====================================
                    # Check if user is already verified. =
                    #=====================================
                    if (!(UserVerificationDetails::isVerified($decrypt)))
                        return redirect()->intended("/dashboard");

                    return view("app.users.user-profile", ["user" => UserVerificationDetails::getUserByID($decrypt)]);
                }
                
                /**
                 * Uploads image -> user/uploadprofilepicture
                 * @param Request $request request
                 * @return View
                 **/
                public function user_profile_update(Request $request)
                {
                    #=================================
                    # Return 403 if not logged in.   =
                    #=================================
                    if (!Auth::check())
                        return abort(403);
                    
                    #=================================
                    # Return 403 if no images found. =
                    #=================================
                    if (!($request->hasFile("user-image-upload")) || !request("user-image-upload")->isValid())
                        return abort(403);
                    
                    #================================
                    # Get uploaded file if success. =
                    #================================
                    $file = $request->file("user-image-upload");
                    
                    #============================================
                    # Sets filename.                            =
                    # fmt: user_id + '-' + time_delta.extension =
                    #============================================
                    $filename = Auth::user()->user_id."-".time().".".$file->getClientOriginalExtension();
                    #============================================
                    # Save truepath.                            =
                    # truepath is used by the system to restore =
                    # image path.                               =
                    #============================================
                    $truepath = "storage/user-images/".$filename;
                    #============================================
                    # Save path.                                =
                    # path is used by the system to store the   =
                    # exact image path from symlink.            =
                    #============================================
                    $path = $file->storeAs("public/user-images", $filename);

                    #==============================================
                    # Return information about updating profile,  =
                    # ex: success | failure                       =
                    #==============================================
                    $info = "";
                    if (!$path)
                        $info = "Something went wrong while uploading your image.";
                    else
                    {
                        if (!(UserProfileImages::updatePath(Auth::user()->user_id, $truepath)))
                            $info = "Something went wrong while updating your profile.";
                        else
                            $info = "Profile updated successfully.";
                    }

                    return back()->with("info", $info);
                }

                public static function delete_user_profile_image(Request $request)
                {
                    #============================
                    # Redirect to login if not  =
                    # login or expired.         =
                    #============================
                    if (!Auth::check())
                        return redirect()->to("/login");
                    
                    $decrypt = null;
                    try
                    { $decrypt = (int) Crypt::decrypt($request->input("user")); }
                    catch (\Illuminate\Contracts\Encryption\DecryptException $e)
                    { return redirect()->to("/dashboard"); }

                    $result = UserProfileImages::deleteUserProfileImageByUserID((Int) $decrypt);
                    if (!$result)
                        return back()->with("info", "Profile image deletetion error!");
                        
                    return back()->with("info", "Successfully deleted profile image.");
                }

                /**
                 * Edit user profile -> user/editprofile
                 * uses: "POST" request
                 * @param Request $request request
                 * @return View
                 **/ 
                public function edit_profile(Request $request)
                {
                    #============================
                    # Redirect to login if not  =
                    # login or expired.         =
                    #============================
                    if (!Auth::check())
                        return redirect()->to("/login");
                    

                    #============================
                    # Validation rules.         =
                    #============================
                    $validator_data = [];
                    $validator_data[      "username"   ] = "required|string|max:50";
                    $validator_data[         "email"   ] = (strcmp(Auth::user()->email, $request->input("email")) === 0)? "required|string|email|max:100|exists:user,email" : "required|string|email|max:100|unique:user";
                    $validator_data[      "password"   ] = (strcmp($request->input("password"), "********") !== 0)? "required|string|regex:/^([_A-Z].*\d+.*)$/|min:8|confirmed" : "required|string|min:8|confirmed";
                    $validator_data[     "firstname"   ] = "required|string|regex:/^([A-Z]\w*(\s?[A-Z]\w*)*)$/|min:2|max:25";
                    $validator_data[      "lastname"   ] = "required|string|regex:/^([A-Z][a-z]*)$/|min:2|max:25";
                    $validator_data[ "middleinitial"   ] = "required|string|regex:/^([A-Z])$/|min:1|max:1";
                    $validator_data[   "designation"   ] = "required|string";
                    $validator_data[   "accesslevel"   ] = "required|string";
                    $validator = Validator::make($request->all(), $validator_data);


                    #===================================
                    # Go back to page if not validate. =
                    #===================================
                    if  ($validator->fails())
                        return redirect()->back()->withErrors($validator)->withInput();

                    #=========================
                    # Update data.           =
                    #=========================
                    $update_data = [];
                    $update_data[ "username"       ] = $request->input("username");
                    $update_data[ "email"          ] = $request->input("email");
                    $update_data[ "firstname"      ] = $request->input("firstname");
                    $update_data[ "lastname"       ] = $request->input("lastname");
                    $update_data[ "middleinitial"  ] = $request->input("middleinitial");
                    $update_data[ "designation_id" ] = $request->input("designation");
                    $update_data[ "accesslevel_id" ] = $request->input("accesslevel");
                    
                    
                    #===================================
                    # Include password if field value  =
                    # is not "********".               =
                    #===================================
                    if (strcmp($request->input("password"), "********") !== 0)
                    $update_data["password"] = Hash::make($request->input("password"));
                    
                    #================================
                    # Update info based on user_id. =
                    #================================
                    $updated = User::where("user_id", "=", Auth::user()->user_id)
                    ->update($update_data);
                    
                    #==================================
                    # Return information about update =
                    # ex: success | failure           =
                    #==================================
                    $info = "";
                    if ($updated)
                        $info = "User profile updated successfully!";
                    else
                        $info = "User profile update failed!";

                    return back()->with("info", $info);
                }

                /**
                 * Update new users verification status -> user/updateverificationstatus
                 * @param Request $request request
                 * @return bool
                 * @example
                 *     Only "admin" has access to this page
                 *         Accesslevel table
                 *             14 := admin
                 **/
                public function updateVerificationStatus(Request $request)
                {
                    #=========================================
                    # Return false if not loggedin as admin. =
                    #=========================================
                    if (!Auth::check() || !Auth::user()->isAdmin())
                        return false;

                    #===============================
                    # Update verificationstatus_id =
                    #===============================
                    $user_id   = $request->input("user_id");
                    $status_id = $request->input("status_id");
                    $signal    = UserVerificationDetails::where("user_id", "=", $user_id)
                                ->update(["verificationstatus_id" => $status_id]);

                    return (bool) $signal;
                }


                /**
                 * Delete verified user -> user/deleteuser
                 * @param Request $request request
                 * @return bool
                 * @example
                 *     Only "admin" has access to this page
                 *         Accesslevel table
                 *             14 := admin
                 **/
                public function deleteUser(Request $request)
                {
                    #=========================================
                    # Return false if not loggedin as admin. =
                    #=========================================
                    if (!Auth::check() || !Auth::user()->isAdmin())
                        return false;

                    #=========================================
                    # Delete user by user_id.                =
                    #=========================================
                    $userid = $request->input("user_id");
                    $signal = UserVerificationDetails::where("user_id", "=", $userid)
                            ->delete();

                    return (bool) $signal;
                }
}
