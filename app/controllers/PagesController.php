<?php
class PagesController extends Controller {
    /**parhamcurtis
     * Class PageController
     * @var false|mixed
     * Author: David AkpELE <akpeledavid@hotmail.com>
     * FROM: MidTech Private Limited
     * @package category 
     */ 

    // =====================================================================================
    // This is like a namespace to accessing our model file that connect us to the database
    // =====================================================================================
    private $dataModel;
    private $namespacemodel;
    public function __construct() {
       @$this->userModel = @$this->loadModel('User');
       @$this->namespacemodel = @$this->loadModel('LoginModel');
    }
    public function index(){
        if(isLoggedManagement()){
              header('location:' . ROOT . 'Dashboard/Default');
            }elseif (isLoggedInStaff()) {
                 header('location:' . ROOT . 'Dashboard/Default');
            }elseif (isLoggedInHr()) {
                 header('location:' . ROOT . 'Dashboard/Default');
            }
        @$data = [
                    'page_title' => 'Application Portal',
                    'meta_tag_content_Seo'=>'Mercy College Unversity Student Portal',
                    'meta_tag_description'=>'Mercy College University Online Student Portal For Undergraduate, Postgraduate and Distance Learning Part Time Students'
                ];
        @$this->view('Default', @$data);    
    }
   
    // Login All Valid MANAGEMENT 
   public function LoginManagement(){
        header("Access-Control-Allow-Origin: *"); 
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        ob_start();
        $jsonString = file_get_contents("php://input");
        $response = array();
        $phpObject = json_decode($jsonString);

        $ManagementLoginCode = $phpObject->{'ManagementLoginAccesscode'};
        $ManagementLogPass = $phpObject->{'ManagementLoginPassword'};
        $rememberme = $phpObject->{'RememberMe'};
        $ValString = json_encode($phpObject);

        $Accesscode = strip_tags(trim(filter_var($ManagementLoginCode, FILTER_SANITIZE_STRING)));
        $password = strip_tags(trim(filter_var($ManagementLogPass, FILTER_SANITIZE_STRING)));
        /**
         * -------------------------------------------------------------------
         * There are Steps to Verify Staff(s) BEFORE Login can proccess Successfully.
         * ------------------------------------------------------------------- 
         * 1. check if the accesscode which serve as username exist on any of the database table
         * 1(a) if the User(Staff) Have a typo error from the accesscode, then throw error  'Invalid Data Provided. Please Try Again Later'
         * 2. check if password is correct, if it not correct throw error 'Sorry..! Wrong Password'
         * 3. check if user is assign to ay department which we need to create the URL PATH of his/her dashboard
         * 3(a)after checking is Accesscode and password matches any User/staffd data on our database table, then check if Amin has Appointed he/she to a department, if not throw error 'Sorry..!Account Confirm. You've not been Appointed Yet.'
         * 4(Confirm Login) .if admin happens to appoint the staff to any department THEN Redirect to Dashboard.
         *
         */
        $processManagementLogin =$this->userModel->LoginManagement($Accesscode);  
        if($processManagementLogin == true){
            $nin = $processManagementLogin->NIN;
            // Fetch ur Role access Role here
            $iv = $this->userModel->mimi($nin);
            if($iv){/**@property-read mixed $name*/
                $code = $processManagementLogin->Accesscode;
                $ie= $this->userModel->MimiPassword($code, $password);
                if($ie){
                    //Now check if access is granted
                    if($processManagementLogin->featured != 1){ /**@property-read mixed $name*/
                        $response['message']='Sorry..! You Account Has Been Disabled.';
                    }elseif ($processManagementLogin->featured == 1) {
                        $fname= $processManagementLogin->Surname;
                        $lname= $processManagementLogin->Othername;
                        $Profemail= $processManagementLogin->Email;
                        $fullname= $fname.' '.$lname;
                        $activeuserid = $iv->ID;
                        $activeusernin = $iv->NIN;
                        $activeuserRole= $iv->Role;
                        $activeuserAccesscode= $processManagementLogin->Accesscode;
                        $activeuserphoto = $processManagementLogin->Profile__Picture;
                        if(!empty($rememberme)){
                            $login1 = $this->ManagementLecturalSession($Profemail, $fullname, $activeusernin, $activeuserid, $activeuserRole,  $activeuserAccesscode, $activeuserphoto);
                            if ($login1) {
                                setcookie ("accesscode",$Accesscode,time()+ 3600);
                                setcookie ("password",$password,time()+ 3600);
                                $_SESSION['cookiecode'] = $_COOKIE['accesscode'];
                                $_SESSION['cookiepass'] = $_COOKIE['password'];
                                $response['status'] = true;
                            }
                        }else {
                            $login1 = $this->ManagementLecturalSession($Profemail, $fullname, $activeusernin, $activeuserid, $activeuserRole,  $activeuserAccesscode, $activeuserphoto);
                            if ($login1) {
                                $response['status'] = true;
                            }
                        }
                    }
                }else { /**@property-read mixed $name */
                    $response['message']= "Sorry..! Wrong Password";
                }
            }else { /**@property-read mixed $name */
                $response['message']= "Access Code Confirmed.! But You've not been Appointed Yet.";
            }
        }else {
                $response['message'] = "Invalid Data Provided. Please Try Again Later";
        }
        ob_end_clean();
        echo json_encode($response);
    }

    public function HZoom(){
        @$zoom_meeting = new zoom();
        @$dataAPi = array();
        @$dataAPi['topic'] = 'David is inviting you to zoom meeting';
        @$dataAPi['start_date'] = date("Y-m-d h:i:s", strtotime('today'));
        @$dataAPi['duration'] =60;
        @$dataAPi['type'] =2;
        @$dataAPi['password'] = '';
                try{
                    @$response = @$zoom_meeting->createMeeting(@$dataAPi);
                    $data=
                        [
                            'page_title'=>'Zoom Conference Call',
                            'Meetingid'=>((isset($response->id))?$response->id: ''),
                            'uuid'=>((null !== (@$response->uuid))?@$response->uuid:''),
                            'host_id'=>((null !== (@$response->host_id))?@$response->host_id:''),
                            'start_url'=>((null !== (@$response->start_url))?@$response->start_url:''),
                            'join_url'=>((null !== (@$response->join_url))?@$response->join_url:''),
                            'password'=>((null !== (@$response->password))?@$response->password:''),
                            'encrypted_password'=>((null !== (@$response->encrypted_password))?@$response->encrypted_password:''),
                            'created_at'=>((null !== (@$response->created_at))?@$response->created_at:''),
                            'timezone'=>((null !== (@$response->timezone))?@$response->timezone:''),
                            'duration'=>((null !== (@$response->duration))?@$response->duration:''),
                            'start_time'=>@((null !== ($response->start_time))?$response->start_time:''),
                            'status'=>((null !== (@$response->status))?@$response->status:''),
                        ];
                }catch(Exception $ex){
                    echo @$ex;
                }
         $this->view('Application/HZoom', $data);
    }
    public function SetZoom(){
        header("Access-Control-Allow-Origin: *"); 
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        ob_start();
        $jsonString = file_get_contents("php://input");
        $Messageresponse = array();
        $phpObject = json_decode($jsonString);
        
        $FromTime=$phpObject->{'FromTime'};
        $totime=$phpObject->{'totime'};
        $Topic=$phpObject->{'inputToPIC'};
        $meetingId=$phpObject->{'meetingId'};
        $securitykey=$phpObject->{'securitykey'};
        $startTime=$phpObject->{'startTime'};
        $timeZone=$phpObject->{'timeZone'};
        $mx =new DateTime($startTime);
        $date1 =  strtotime($FromTime);
        $date2 =  strtotime($totime);

        $diff = ($date2 - $date1);
        $Setmin = date("i", $diff);
        $Sethr = date("h", $diff);
        if ($Setmin > 50 || $Sethr >01) {
            $Messageresponse['message']= "You duration can not be more than 1hr. else subscribe for premier";
        }else {
            @$zoom_meeting = new zoom();
            @$dataAPi = array();
            @$dataAPi['topic'] = $Topic;
            // @$dataAPi['start_date'] = date("Y-m-d h:i:s", strtotime('today'));
            @$dataAPi['start_time'] = $startTime;
            @$dataAPi['duration'] =$Setmin;
            @$dataAPi['type']=2;
            @$dataAPi['timezone']=$timeZone;
            @$dataAPi['password'] = $securitykey;
            $newJsonString = json_encode($phpObject);
             if($newJsonString){
                try{
                        @$response = @$zoom_meeting->createMeeting(@$dataAPi);
                        $Messageresponse['status'] =  3;
                        $Messageresponse['Successmessage'] = 'Successfully Scheduled.';
                    }catch(Exception $ex){
                        echo @$ex;
                    }
            }else {
                $Messageresponse['message']= 'FAIL';
            }
        }
        ob_end_clean();
        echo json_encode($Messageresponse);
    }

    
    public function Default(){
        if (isLoggedManagement()) {
            if (!isLoggedDashboardController() && !iscsrf()) {
               header('location:' . ROOT . 'Dashboard/juio');
            }elseif (isLoggedDashboardController()){
                @$data = ['page_title'=>'Managament :: Dashboard Control Center',];
                @$this->view('Dashboard/Default', $data);
            }elseif(iscsrf()) {
                @$data = ['page_title'=>'Managament :: Dashboard Control Center',];
                @$this->view('Dashboard/Default', $data);
            }
        }else {
            header('location:' . ROOT . 'Dashboard');
        }
    }
    public function Juio(){ 
        if (isLoggedManagement()) {
            if (isLoggedDashboardController()) {
                $nin =  $_SESSION['UsenrNin'];
                $check = $this->userModel->mimi($nin);
                if($check) {
                    $array = $check->Base;  
                    $searchForValue = ',';
                    if (strpos($array, $searchForValue) !== false) {
                    // Here is Multiple department 
                        $rs = $this->namespacemodel->ArrayFlag($array);
                                      
                    }
                }
            }else {
                 header('location:' . ROOT . 'Dashboard/Default');
            }
           
        }     
    }
    public function Student(){
        if (isLoggedManagement() && isLoggedDashboardController()) {
            $departmentid = $_SESSION['DashboardID']; 
            $Fetchstuddents= $this->namespacemodel->fetchstudent($departmentid);
            $mim =  $_SESSION['ProfessorID'];
            $emailstmt = $this->userModel->SqlFetchProfessEmails($mim);
            if($Fetchstuddents < 1){
                $NullData = '<div class="alert alert-danger tex-center" role="alert">Sorry..! No Student Has Register For This Course.. The table is empty.!</div>';
            }
            if(isset($_POST['delete'])){
                $checkbox = $_POST['checkbox'];
                for($i=0;$i<count($_POST['checkbox']);$i++){
                $del_id = $checkbox[$i];
                }
            }
        }elseif(isLoggedManagement() && iscsrf()) {
           $departmentid = $_SESSION['base']; 
           $mim =  $_SESSION['ProfessorID'];
            $Fetchstuddents= $this->namespacemodel->fetchstudent($departmentid);
            $emailstmt = $this->userModel->SqlFetchProfessEmails($mim);
                if($Fetchstuddents < 1){
                    $NullData = '<div class="alert alert-danger tex-center" role="alert">Sorry..! No Student Has Register For This Course.. The table is empty.!</div>';
                }
                if(isset($_POST['delete'])){
                    $checkbox = $_POST['checkbox'];
                    for($i=0;$i<count($_POST['checkbox']);$i++){
                    $del_id = $checkbox[$i];
                    print_r($del_id);
                    } 
                }
        }else {
            header('location:' . ROOT . 'Dashboard/Default');
        }
        $data = 
            [   
                'page_title'=>'Professor  :: Students Dashboard',
                'fetchstudent'=>$Fetchstuddents,
                'NullData'=>((isset($NullData))?$NullData: ''),
                'emailstmt'=>$emailstmt,
            ];
            $this->view('Dashboard/Student', $data);
        
    }
    protected function RandomToken($length = 32){
        if(!isset($length) || intval($length) <= 8 ){
            $length = 32;
        }
        if (function_exists('random_bytes')) {
            return bin2hex(random_bytes($length));
        }
        if (function_exists('mcrypt_create_iv')) {
            return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
    }
    protected function Salt(){
        return substr(strtr(base64_encode(hex2bin($this->RandomToken(32))), '+', '.'), 0, 44);
    }
    // =========================================================
    // Creating session for Lectural on management section
    // =========================================================

    public function ManagementLecturalSession($Profemail, $fullname, $activeusernin, $activeuserid, $activeuserRole,  $activeuserAccesscode, $activeuserphoto){
        @$Active_login = date("Y-m-d H:i:s");
        @$Route = @$this->namespacemodel->lastlogManagement($Active_login, $activeusernin, $activeuserAccesscode);
        if($Route){ 
            $_SESSION['Fullname']= $fullname;
            $_SESSION['UsenrNin'] = $activeusernin;
            $_SESSION['ProfessorID']  = $activeuserid;
            $_SESSION['Accesscode'] = $activeuserAccesscode;
            $_SESSION['Profile__Picture']= $activeuserphoto;
            $_SESSION['Prof_email']= $Profemail;
            $_SESSION['ProfTimestart'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['ProfTimestart'] + (30 * 60);
            if ($_SESSION['expire']) {

                return true;
            }
        }else {
            return false;
        }  
    }
     public function ManagementDashboardLogin(){
        header("Access-Control-Allow-Origin: *"); 
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        ob_start();
        $jsonString = file_get_contents("php://input");
        $response = array();
        $phpObject = json_decode($jsonString);
        $DashboardID = $phpObject->{'ID'};
        $ValString = json_encode($phpObject);
        $data = ['ID'=>trim(filter_var(strip_tags($DashboardID, FILTER_SANITIZE_STRING)))];
        
        if (!empty($data['ID'])) {
            $baseID= $data['ID'];
            if($this->SessionDashboard($baseID)){
                $_SESSION['csrf'] = $this->RandomToken();
                $_SESSION['saltcsrf'] = $this->Salt();
                $_SESSION['base'] = $baseID;
                $response['status'] = true;
            }else {
                $response['message'] = 'Something went wrong';
            }
        }
        ob_end_clean();
        echo json_encode($response);
    }
    // =======================================================
    // THIS AREA IS TO DESTROY SESSION AND UNSET ALL SESSION
    // =======================================================

    public function Migrate(){
        if (session_status() == PHP_SESSION_ACTIVE) {
            unset($_SESSION['DashboardID']);
            header('location:' . ROOT . 'Dashboard');
        }
    }
    public function SessionDashboard($baseID){
        $_SESSION['DashboardID'] = $baseID;
        if ($_SESSION['DashboardID']) {
            echo "<script>
                    window.location.replace('". ROOT ."Dashboard/Defualt');
                </script>";
            return true; 
        }else {
            return false;
        }
    }
      // Logout for Management On management
	public function LogoutLectural(){
        if (session_status() == PHP_SESSION_ACTIVE) {
            if (isLoggedManagement() && !isLoggedDashboardController() && !iscsrf()) {
                unset($_SESSION['ProfessorID']);
                unset($_SESSION['Fullname']);
                unset($_SESSION['Accesscode']);
                unset($_SESSION['UsenrNin']);
                unset($_SESSION['Profile__Picture']);
                unset($_SESSION['expire']);
                unset($_SESSION['DashboardID']);
                header('location:' . ROOT);
            }elseif (isLoggedDashboardController()) {
                unset($_SESSION['ProfessorID']);
                unset($_SESSION['Fullname']);
                unset($_SESSION['Accesscode']);
                unset($_SESSION['UsenrNin']);
                unset($_SESSION['Profile__Picture']);
                unset($_SESSION['expire']);
                unset($_SESSION['DashboardID']);
                header('location:' . ROOT);
            }elseif (iscsrf()) {
                unset($_SESSION['ProfessorID']);
                unset($_SESSION['Fullname']);
                unset($_SESSION['Accesscode']);
                unset($_SESSION['UsenrNin']);
                unset($_SESSION['Profile__Picture']);
                unset($_SESSION['expire']);
                unset($_SESSION['DashboardID']);
                unset($_SESSION['ProfTimestart']);
                unset($_SESSION['Prof_email']);
                unset($_SESSION['csrf']);
                unset($_SESSION['saltcsrf']);
                unset($_SESSION['base']); 
                header('location:' . ROOT);
            }
        }
    } 

}

//https://fmovies.co/film/numb3rs-season-1-14556?play=13