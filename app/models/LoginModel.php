<?php 
    class LoginModel
    {
        /**
         * LoginModel Processing Model
         *
         * @var [type]
         */
        private $RouteDatabase;
        public function __construct(){
            @$this->RouteDatabase = new Database;
        }

        public function mimix($basepath){
            @$this->RouteDatabase->query("SELECT Child_id, Child_name FROM `sublist` WHERE Child_id = :basepath");
            @$this->RouteDatabase->bind(':basepath', $basepath);
            @$result = @$this->RouteDatabase->single();
            if($result){ 
                return @$result;
            }else {
                return false;
            }
        }

        public function lastlogManagement($Active_login, $activeusernin, $activeuserAccesscode){
            @$this->RouteDatabase->query("SELECT NIN, Accesscode FROM (SELECT NIN, Accesscode as Accesscode FROM human_resources UNION ALL SELECT NIN, Accesscode FROM lecturals) x WHERE Accesscode = :activeuserAccesscode AND NIN = :activeusernin ");
            //Bind the values 
            @$this->RouteDatabase->bind(':activeuserAccesscode', $activeuserAccesscode);
            @$this->RouteDatabase->bind(':activeusernin', $activeusernin);
            @$runAccountant = @$this->RouteDatabase->single();
            return @$runAccountant;
        }
            

        public function setExamDepo($question, $answer, $wrong1,  $wrong2, $wrong3, $wrong4, $AnswersButtonType, $configId){
            $this->RouteDatabase->query("INSERT INTO `examination__center`
            (`Courseid`, `question`, `answer`, `option 1`, `option 2`, `option 3`, `option 4`, `Ansbutton`)
                                     VALUES(:configId, :question, :answer, :wrong1, :wrong2, :wrong3, :wrong4, :AnswersButtonType)");
            $this->RouteDatabase->bind(':question', $question);
            $this->RouteDatabase->bind(':answer', $answer);
            $this->RouteDatabase->bind(':wrong1', $wrong1);
            $this->RouteDatabase->bind(':wrong2', $wrong2);
            $this->RouteDatabase->bind(':wrong3', $wrong3);
            $this->RouteDatabase->bind(':wrong4', $wrong4);
            $this->RouteDatabase->bind(':AnswersButtonType', $AnswersButtonType);
            $this->RouteDatabase->bind(':configId', $configId);
            if($this->RouteDatabase->execute()){
                return true;
            }else {
                return false;
            }
        }

        public function SetExamTimer($basseRoll, $Time){
            $this->RouteDatabase->query("INSERT INTO `examination__timeset`(`Department`, `StartTime`) VALUE(:basseRoll, :Time)");
            $this->RouteDatabase->bind(':Time', $Time);
            $this->RouteDatabase->bind(':basseRoll', $basseRoll);
            if ($this->RouteDatabase->execute()) {
               return true;
            }else {
                return false;
            }
        }
        public function calluserfun($Courseid){
            @$this->RouteDatabase->query('SELECT * FROM examination__center WHERE Courseid = :Courseid');
            $this->RouteDatabase->bind(':Courseid', $Courseid);
            @$num = @$this->RouteDatabase->resultSet();
            if(!empty($num)) {
                return  @$num;
            }else {
                return false;
            }
        }

        public function examTimer($Courseid){
            @$this->RouteDatabase->query('SELECT * FROM examination__timeset WHERE Department = :Courseid');
             $this->RouteDatabase->bind(':Courseid', $Courseid);
            @$timeset = @$this->RouteDatabase->single();
            if(!empty($timeset)){
                return $timeset;
            }else {
                return false;
            }
        }

        public function ExamCount(){
            @$this->RouteDatabase->query('SELECT * FROM examination__center');
            @$num = @$this->RouteDatabase->rowCount();
            return  @$num;
        }
        
        public function UpdateExamAnswers($userselected, $i){
            $this->RouteDatabase->query('UPDATE examination__center SET Student__answer = :userselected WHERE No = :i');
            $this->RouteDatabase->bind(':userselected', $userselected);
            $this->RouteDatabase->bind(':i', $i);
            if($this->RouteDatabase->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function StudentRecords(){
            $this->RouteDatabase->query('SELECT answer, Student__answer FROM examination__center');
            $Statement = $this->RouteDatabase->resultSet();
            return $Statement;
        }
        public function FetchStudentData($id){
            @$this->RouteDatabase->query('SELECT * FROM student__account WHERE student__Id = :id');
            $this->RouteDatabase->bind(':id', $id);
            @$row = $this->RouteDatabase->single();
            if(!empty($row)){
                return  @$row;
            }
        }
        public function FetchStudentDepartmentName($Courseid){
            @$this->RouteDatabase->query('SELECT * FROM sublist WHERE Child_id = :Courseid');
            $this->RouteDatabase->bind(':Courseid', $Courseid);
            @$row = $this->RouteDatabase->single();
            if(!empty($row)){
                return  @$row;
            }
        }
        public function FetchStudentCategoryName($Courseid){
            $this->RouteDatabase->query('SELECT Cat_id, Child_id, Category__ID, Category__name FROM `categories`, `sublist` 
                                        WHERE `Child_id` = :Courseid AND Category__ID = Cat_id');
            $this->RouteDatabase->bind(':Courseid', $Courseid);
            $stmt = $this->RouteDatabase->single();
            return $stmt;
        }
        public function cat($ftyType){
            $this->RouteDatabase->query('SELECT * FROM `Faculty__tb` WHERE `Faculty__ID` = :ftyType');
            $this->RouteDatabase->bind(':ftyType', $ftyType);
            $fty__stmt = $this->RouteDatabase->single();
            return $fty__stmt;
        }
        public function scheduleZoomMeeting($HosterId, $HostLink, $ZTopic, $Timeframe, $duration, $ZID, $Zpassword){
            $this->RouteDatabase->query('INSERT INTO `ZoomSchedule` (HosterID, Zoom__Topic, Scheduled__TIME, Duration, Zoom_ID, Zoom__link, Zoom__Password, time)
                                        VALUES(:HosterId, :ZTopic, :Timeframe, :duration, :ZID, :HostLink, :Zpassword, NOW()) ');
            $this->RouteDatabase->bind(':HosterId', $HosterId);
            $this->RouteDatabase->bind(':ZTopic', $ZTopic);
            $this->RouteDatabase->bind(':Timeframe', $Timeframe);
            $this->RouteDatabase->bind(':duration', $duration);
            $this->RouteDatabase->bind(':ZID', $ZID);
            $this->RouteDatabase->bind(':HostLink', $HostLink);
            $this->RouteDatabase->bind(':Zpassword', $Zpassword);
            if($this->RouteDatabase->execute()){
                return true;
            }else {
                return false;
            }   
        }

        public function fetchZoomdata(){
            $this->RouteDatabase->query('SELECT * FROM ZoomSchedule ORDER BY time ');
            $row = $this->RouteDatabase->resultSet();
            if($row <= 1){
                return $row;
            }
        }

        public function isCounter($Courseid){
            $this->RouteDatabase->query('SELECT * FROM examination__center WHERE Courseid =:Courseid');
            $this->RouteDatabase->bind(':Courseid', $Courseid);
            @$num = @$this->RouteDatabase->rowCount();
            return  @$num;
        }

        public function isStudentComment($data){
            $this->RouteDatabase->query('INSERT INTO blogcomments (User_id, Post_id, c_token, body, created_at)
                                VALUES(:CommentUSERID, :Postid, :c_token, :Comment, :timePosted)');
            $this->RouteDatabase->bind(':CommentUSERID', $data['CommentUSERID']);
            $this->RouteDatabase->bind(':Postid', $data['Postid']);
            $this->RouteDatabase->bind(':c_token', $data['c_token']);
            $this->RouteDatabase->bind(':Comment', $data['Comment']);
            $this->RouteDatabase->bind(':timePosted', $data['timePosted']);
            if($this->RouteDatabase->execute()){
			    return true;
            }else {
                return false;
            }
        }
    
        public function createBlogPost($data){
            $this->RouteDatabase->query("INSERT INTO schoolblog (User_id, Post_id, body, created_at) VALUES(:UserId, :BlogPostId, :FeedPost,:timePosted)");
            $this->RouteDatabase->bind(':UserId', $data['UserId']);
            $this->RouteDatabase->bind(':FeedPost', $data['FeedPost']);
            $this->RouteDatabase->bind(':BlogPostId', $data['BlogPostId']);
            $this->RouteDatabase->bind(':timePosted', $data['timePosted']);
            if($this->RouteDatabase->execute()){
			    return true;
            }else {
                return false;
            }
        }
        public function ArrayFlag($array){
            $ids = $array;
            $this->RouteDatabase->query("SELECT * FROM sublist WHERE Child_id IN (".$ids.") ");
            $ids =array();
            if (is_array($ids) || !is_array($ids))
            foreach ($ids as $k => $id)	
            $this->DB->bind(($k+1), $id);
            $run = $this->RouteDatabase->resultSet();
            if($run){
                return $run;
            }else {
                return false;
            }
        }

        public function fetchstudent($departmentid){
            $this->RouteDatabase->query("SELECT student__Id, Roll__No,
                                                Application__Type, Department__Type, 
                                                Program__Type, NIN, Entrylevel, Surname, 
                                                othername, Date__of__birth, gender, 
                                                email, featured, relationship, telephone,
                                                session FROM student__account WHERE Department__Type = :departmentid");
            $this->RouteDatabase->bind(':departmentid', $departmentid);
            $sql = $this->RouteDatabase->resultSet();
            if($sql == true){
                return $sql;
            }else {
                return false;
            }
        }
        public function FetchApplicationType($stdappTy){
            $this->RouteDatabase->query("SELECT * FROM categories WHERE Category__ID = :stdappTy");
            $this->RouteDatabase->bind(':stdappTy', $stdappTy);
            $stmt= $this->RouteDatabase->resultSet();
             if($stmt == true){
                return $stmt;
            }else {
                return false;
            }
        }
        public function fetchStudentDepartment($stdDpt){
            $this->RouteDatabase->query("SELECT * FROM sublist WHERE Child_id = :stdDpt");
            $this->RouteDatabase->bind(':stdDpt', $stdDpt);
            $stmt2 = $this->RouteDatabase->resultSet();
             if($stmt2 == true){
                return $stmt2;
            }else {
                return false;
            }
        }
    }
    