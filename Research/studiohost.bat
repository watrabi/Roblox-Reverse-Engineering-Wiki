@echo off

set /p map=Drag map into here 


echo What is the port
set /p Port="port: "

start RobloxStudioBeta.exe -localPlaceFile %map%  -task StartServer -port %port%



