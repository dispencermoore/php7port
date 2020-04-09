@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../etsy/phan/phan_client
php "%BIN_TARGET%" %*
