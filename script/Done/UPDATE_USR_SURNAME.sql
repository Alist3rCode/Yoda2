UPDATE yda_users SET USR_SURNAME = UPPER(concat(substr(USR_FIRST_NAME, 1,1), substr(USR_NAME, 1,2))) 
WHERE USR_SURNAME IS NULL
