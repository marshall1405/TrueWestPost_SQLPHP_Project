<?php
   
class DatabaseHelper
{
    const username = 'xxxxxxxx';
    const password = 'xxxxxxxx';
    const con_string = 'xxxxxxxx';
   
    protected $conn;

    public function __construct()
    {
        try {
            $this->conn = oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );
            if (!$this->conn) {
                die("DB error: Connection can't be established!");
            }
   
        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }
   
    public function __destruct()
    {
        oci_close($this->conn);
    }

    //HOUSES

    public function selectAllHouses($houseID, $houseName, $creatorCount, $fanCount){
        $sql = "SELECT * FROM Houses WHERE HouseID LIKE '%{$houseID}%' ORDER BY HOUSEID ASC";

        $statement = oci_parse($this->conn, $sql);

        oci_execute($statement);
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        oci_free_statement($statement);

        return $res;
    }

    public function insertIntoHouses($houseName){
        $sql = "INSERT INTO Houses(HouseName) VALUES ('{$houseName}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    public function deleteHouse($houseID){
        $errorcode = 0;
        $sql = 'BEGIN P_DELETE_HOUSE(:houseID, :errorcode); END;';
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':houseID', $houseID);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);
        oci_free_statement($statement);

        return $errorcode;
    }

    public function updateHouse($houseID, $houseName){
        $sql = "UPDATE Houses SET HouseName = '{$houseName}' WHERE HouseID = {$houseID}";
        
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);

        return $success;
    }

    //ACCOUNTS

    public function insertIntoAccounts($accountName, $email, $age, $accountHouseID, $accountHouseRoleID){
        $sql = "INSERT INTO Accounts(AccountName, Email, Age, HouseID, HouseRoleID) VALUES ('{$accountName}', '{$email}', {$age}, {$accountHouseID}, {$accountHouseRoleID})";
    
        $statement = oci_parse($this->conn, $sql);
    
        if (!$statement) {
            $error = oci_error($this->conn);
            echo "Insert error: " . $error['message'];
            return false;
        }
    
        $success = oci_execute($statement) && oci_commit($this->conn);
    
        if (!$success) {
            $error = oci_error($statement);
            echo "Execute/Commit error: " . $error['message'];
        }
    
        oci_free_statement($statement);
        return $success;
    }
    

    public function selectAllAccounts($accountID, $accountName, $email, $age, $accountHouseID, $accountHouseRoleID){
        $sql = "SELECT * FROM Accounts WHERE AccountID LIKE '%{$accountID}%' ORDER BY ACCOUNTID ASC";

        $statement = oci_parse($this->conn, $sql);

        oci_execute($statement);
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        oci_free_statement($statement);

        return $res;
    }

    public function updateAccount($accountID, $accountName, $email, $age, $accountHouseID, $accountHouseRoleID){
        $sql = "UPDATE Accounts SET AccountName = '{$accountName}', Email = '{$email}', Age = '{$age}', HouseID = '{$accountHouseID}', HouseRoleID = '{$accountHouseRoleID}' WHERE AccountID = {$accountID}";
        
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);

        return $success;
    }


    //HOUSEROLES

    public function selectAllHouseRoles($houseRoleID, $houseRoleName, $tasks){
        $sql = "SELECT * FROM HouseRoles WHERE HouseRoleID LIKE '%{$houseRoleID}%' ORDER BY HOUSEROLEID ASC";

        $statement = oci_parse($this->conn, $sql);

        oci_execute($statement);
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        oci_free_statement($statement);

        return $res;
    }

    //CREATOR
    
    public function selectAllCreators($creatorID, $creatorAccountID, $creatorFanCount, $monthlyReaderCount){
        $sql = "SELECT * FROM Creators WHERE CreatorID LIKE '%{$creatorID}%' ORDER BY CREATORID ASC";

        $statement = oci_parse($this->conn, $sql);

        oci_execute($statement);
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        oci_free_statement($statement);

        return $res;
    }

    //COLLABORATION

    public function selectAllCollaborations($collaborationID, $collaborationCreator1, $collaborationCreator2){
        $sql = "SELECT * FROM Collaborations WHERE CollaborationID LIKE '%{$collaborationID}%' ORDER BY COLLABORATIONID ASC";

        $statement = oci_parse($this->conn, $sql);

        oci_execute($statement);
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        oci_free_statement($statement);

        return $res;
    }


    //ARTICLE

    public function selectAllArticles($articleID, $articleName, $isCollaboration,$articleAuthor,$articleCollaboration, $articleReaderCount, $articleOpinionCount){
        $sql = "SELECT * FROM Articles WHERE ArticleID LIKE '%{$articleID}%' ORDER BY OPINIONCOUNT DESC";

        $statement = oci_parse($this->conn, $sql);

        oci_execute($statement);
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        oci_free_statement($statement);

        return $res;
    }

    //OPINIONS

    public function selectAllOpinions($opinionCreatorID, $opinionArticleID, $opinionReaderCount, $opinionCommunityRating){
        $sql = "SELECT * FROM Opinions WHERE CreatorID LIKE '%{$opinionCreatorID}%' AND ArticleID LIKE '%{$opinionArticleID}%' ORDER BY CREATORID ASC";

        $statement = oci_parse($this->conn, $sql);

        oci_execute($statement);
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        oci_free_statement($statement);

        return $res;
    }
    


    //GETTER

    public function getCurrentHouseName($houseID){
        $sql = "SELECT HouseName FROM Houses WHERE HouseID = {$houseID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $currentHouseName = isset($row['HOUSENAME']) ? $row['HOUSENAME'] : null;

        oci_free_statement($statement);

        return $currentHouseName;
    }

    public function getCurrentCreatorCount($houseID){
        $sql = "SELECT CreatorCount FROM Houses WHERE HouseID = {$houseID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $currentCreatorCount = isset($row['CREATORCOUNT']) ? $row['CREATORCOUNT'] : null;

        oci_free_statement($statement);

        return $currentCreatorCount;
    }

    public function getCurrentFanCount($houseID){
        $sql = "SELECT FanCount FROM Houses WHERE HouseID = {$houseID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $currentFanCount = isset($row['FANCOUNT']) ? $row['FANCOUNT'] : null;

        oci_free_statement($statement);

        return $currentFanCount;
    }

    public function getCurrentAccountName($accountID){
        $sql = "SELECT AccountName FROM Accounts WHERE AccountID = {$accountID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $currentAccountName = isset($row['ACCOUNTNAME']) ? $row['ACCOUNTNAME'] : null;

        oci_free_statement($statement);

        return $currentAccountName;
    }

    public function getCurrentEmail($accountID){
        $sql = "SELECT Email FROM Accounts WHERE AccountID = {$accountID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $currentEmail = isset($row['EMAIL']) ? $row['EMAIL'] : null;

        oci_free_statement($statement);

        return $currentEmail;
    }

    public function getCurrentAge($accountID){
        $sql = "SELECT AGE FROM Accounts WHERE AccountID = {$accountID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $currentAge = isset($row['AGE']) ? $row['AGE'] : null;

        oci_free_statement($statement);

        return $currentAge;
    }

    public function getCurrentAccountHouseID($accountID){
        $sql = "SELECT HouseID FROM Accounts WHERE AccountID = {$accountID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $currentAccountHouseID = isset($row['HOUSEID']) ? $row['HOUSEID'] : null;

        oci_free_statement($statement);

        return $currentAccountHouseID;
    }

    public function getCurrentAccountHouseRoleID($accountID){
        $sql = "SELECT HouseRoleID FROM Accounts WHERE AccountID = {$accountID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $currentAccountHouseRoleID = isset($row['HOUSEROLEID']) ? $row['HOUSEROLEID'] : null;

        oci_free_statement($statement);

        return $currentAccountHouseRoleID;
    }

    //HELPER METHODS
    public function houseExists($houseID){
        $sql = "SELECT COUNT(*) AS COUNT FROM Houses WHERE HouseID = {$houseID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $count = $row['COUNT'];

        oci_free_statement($statement);
        
        return $count > 0;
    }

    public function accountExists($accountID){
        $sql = "SELECT COUNT(*) AS COUNT FROM Accounts WHERE AccountID = {$accountID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $count = $row['COUNT'];

        oci_free_statement($statement);
        
        return $count > 0;
    }

    public function houseRoleExists($houseRoleID){
        $sql = "SELECT COUNT(*) AS COUNT FROM HouseRoles WHERE HouseRoleID = {$houseRoleID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $count = $row['COUNT'];

        oci_free_statement($statement);
        
        return $count > 0;
    }


    //PROCEDURE METHODS

    public function updateMostInfluentialArticle($articleName) {
        $sql = "BEGIN changeMostInfluentialArticleName('{$articleName}'); END;";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);

        return $success;
    }

    public function getMessages(){
        $messages = [];

        $sql = "SELECT message FROM OutputMessages";
        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        while ($row = oci_fetch_assoc($statement)) {
            $messages[] = $row['MESSAGE'];
        }

        oci_free_statement($statement);

        return $messages;
    }
    
    
    //DELETING ACCOUNTS

    public function creatorForThisAccountExists($accountID){
        $sql = "SELECT COUNT(*) AS COUNT FROM Creators WHERE AccountID = {$accountID}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        $row = oci_fetch_assoc($statement);
        $count = $row['COUNT'];

        oci_free_statement($statement);
        
        return $count > 0;
    }

    public function decreaseCreatorCount($houseID){
        $sql = "UPDATE Houses SET CreatorCount = CreatorCount-1 WHERE HouseID='{$houseID}'";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);

        return $success;
    }

    public function decreaseFanCount($houseID){
        $sql = "UPDATE Houses SET FanCount = FanCount-1 WHERE HouseID='{$houseID}'";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);

        return $success;
    }

    public function deleteAccount($accountID){
        // Use $this instead of $database
        $isCreator = $this->creatorForThisAccountExists($accountID);
        $currentHouseID = $this->getCurrentAccountHouseID($accountID);
    
        if($isCreator == true){
            $this->decreaseCreatorCount($currentHouseID);
        }else{
            $this->decreaseFanCount($currentHouseID);
        }
    
        $sql = "DELETE FROM Accounts WHERE AccountID = '{$accountID}'";
    
        $statement = oci_parse($this->conn, $sql);
    
        if(!$statement){
            $error = oci_error($this->conn);
            echo "Delete error: " . $error['message'];
            return false;
        }
    
        $success = oci_execute($statement) && oci_commit($this->conn);
    
        if(!$success){
            $error = oci_error($statement);
            echo "Execute/Commit error: " . $error['message'];
        }
    
        oci_free_statement($statement);
        return $success;
    }
    
    

}