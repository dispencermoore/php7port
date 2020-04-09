@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../etsy/phan/phan
php "%BIN_TARGET%" %*
