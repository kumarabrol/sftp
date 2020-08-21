###SFTP
>This repo offers php based sftp server that is allowed user to upload or download file as they want

Environment and technology requested:
* apache >=2
* php >=5.5

Using docker to deploy image:

image: https://ecr.vip.ebayc3.com/repository/seller/seller_ftp_php_pro

```
//-v hostname:docker_path
docker run -dit --name ftp -p:80:80 -v /ETL_Temp_File_Folder:/var/www/html/ETL_Temp_File_Folder ecr.vip.ebayc3.com/seller/seller_ftp_php_pro
```

Production Environments:

```
host: 10.115.130.93
default file path:
/ETL_Temp_File_Folder
```









# sftp
