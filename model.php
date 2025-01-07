<?php

/**
 * model.php 
 * Script that interacts with the database
 * @author Oghenetejiri Peace Onosajerhe
 * @version 1.0
 * @package top_d_profiler_api
 */


include 'connect_db.php';
connectDatabase();

/**
 *  getUserId: Retrieves the user ID
 * @param string $name$userName
 * @return void
 */
function getUserId($userName) {
    global $pdo;
    $query = "SELECT user_id FROM users WHERE username=?";
    $statement = $pdo->prepare($query);
    $statement->execute([$userName]);
    $uid = $statement->fetch(PDO::FETCH_ASSOC);
    if($uid)
        $_SESSION['uid'] = $uid['user_id'];
}


/**
 *  create_account: Creates a new profile for  a user
 * @param string $fName
 * @param string $mName
 * @param string $lName
 * @param string $email
 * @param string $phoneNum
 * @param string $userName
 * @param string $password
 * @param string $birtheDate
 * @param string $gender
 * @param string $country
 * @param string  $state_prov
 * @param string $city
 * @param string $streetAddress
 * @param string $postalCode
 * @return void
 */
    function create_account($fName, $mName, $lName, $email, $phoneNum, $userName, $password, $birtheDate, $gender, $country, $state_prov, $city, $streetAddress, $postalCode) {
    global $pdo;
    $query = "INSERT INTO users (username, password) VALUES (?,?);";
    $statement = $pdo->prepare($query);
    $statement->execute([$userName, $password]);
    getUserId($userName);

    if(isset($_SESSION['uid'])) {
        $uid = (int) $_SESSION['uid'];
        $queryCreateAccount = "INSERT INTO account(user_id, firstname, middlename, lastname, email, phone_no, birthdate, gender) VALUES (?,?,?,?,?,?,?,?);";
        $statementInsertion = $pdo->prepare($queryCreateAccount);
        $statementInsertion->execute([$uid, $fName, $mName, $lName, $email, $phoneNum, $birtheDate, $gender]);
        }

    return ;
}

/**
 *  access_account: Retreives data of the user
 * @return void
 */
function access_account() {
    return;
}

/**
 *  update_account: Modifies or edit user's profile
 * @return void
 */
function update_account() {
    return;
}

/**
 *  delete_account: Delete the user's profile
 * @return void
 */
function delete_account() {
    return;
}


create_account('Peace', 'Oghenetejiri', 'Onosajerhe', 'peaceking@gmail.com', '+19012156366', 'kingtop', '$password2', '1999-06-24', 'm', '$country', '$state_prov', '$city', '$streetAddress', '$postalCode');



echo json_encode($_SESSION['uid']);

    if(isset($_SESSION['uid'])) {
        session_destroy();
        session_unset();
            }
?>