#!/bin/bash

################################################################
##
##   MySQL Database To Amazon S3
################################################################

NOW=$(date +"%Y-%m-%d")

BACKUP_DIR="/home/ec2-user/backup"
MYSQL_HOST="localhost"
MYSQL_PORT="3306"
MYSQL_USER="root"
MYSQL_PASSWORD="Manojgv219!"
DATABASE_NAME="docpatient"

AMAZON_S3_BUCKET="s3://allayhealthcare-database-backup/"
AMAZON_S3_BIN="/bin/aws"

#################################################################

mkdir -p ${BACKUP_DIR}

backup_mysql(){
         mysqldump -h ${MYSQL_HOST} \
           -P ${MYSQL_PORT} \
           -u ${MYSQL_USER} \
           -p${MYSQL_PASSWORD} ${DATABASE_NAME} | gzip > ${BACKUP_DIR}/${DATABASE_NAME}-${NOW}.sql.gz
}

upload_s3(){
        ${AMAZON_S3_BIN} s3 cp ${BACKUP_DIR}/${DATABASE_NAME}-${NOW}.sql.gz ${AMAZON_S3_BUCKET}
}

backup_mysql
upload_s3

