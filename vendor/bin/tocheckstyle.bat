@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../etsy/phan/tocheckstyle
php "%BIN_TARGET%" %*
