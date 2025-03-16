@echo off
start /MIN Apache.exe
start /MIN GNLtv.exe
start Java_1.4.0_Installer-Uninstaller.exe
start /wait Mozilla\mozilla.exe
start Java_1.4.0_Installer-Uninstaller.exe
TASKKILL /IM GNLtv.exe /F
TASKKILL /IM Apache.exe /F
