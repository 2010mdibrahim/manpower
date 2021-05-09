<?php
class UnsetFailedLogin{
    public function unset_failed_login()
    {
        unset($_SESSION['failed_login']);
    }
}