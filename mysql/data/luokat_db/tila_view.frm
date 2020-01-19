TYPE=VIEW
query=select `luokat_db`.`varaus`.`id` AS `id`,`luokat_db`.`varaus`.`varaus` AS `varaus`,`luokat_db`.`kurssit`.`nimi` AS `kurssi`,`luokat_db`.`varaus`.`oppi_aine` AS `aihe`,`luokat_db`.`tilat`.`nimi` AS `tila`,`luokat_db`.`kouluttajat`.`nimi` AS `kouluttaja` from (((`luokat_db`.`varaus` join `luokat_db`.`kouluttajat` on((`luokat_db`.`varaus`.`kouluttaja_id` = `luokat_db`.`kouluttajat`.`id`))) join `luokat_db`.`kurssit` on((`luokat_db`.`varaus`.`kurssi_id` = `luokat_db`.`kurssit`.`id`))) join `luokat_db`.`tilat` on((`luokat_db`.`varaus`.`tila_id` = `luokat_db`.`tilat`.`id`)))
md5=a4eace134534c56588696e10f994f5f6
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2020-01-18 16:18:45
create-version=1
source=SELECT\n    `varaus`.`id`,\n    `varaus`.`varaus`,\n    `kurssit`.`nimi` AS `kurssi`,\n    `varaus`.`oppi_aine` AS `aihe`,\n    `tilat`.`nimi` AS `tila`,\n    `kouluttajat`.`nimi` AS `kouluttaja`\nFROM\n    (\n        (\n            (\n                `varaus`\n            INNER JOIN `kouluttajat` ON `kouluttaja_id` = `kouluttajat`.`id`\n            )\n        INNER JOIN `kurssit` ON `kurssi_id` = `kurssit`.`id`\n        )\n    INNER JOIN `tilat` ON `tila_id` = `tilat`.`id`\n    )
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `luokat_db`.`varaus`.`id` AS `id`,`luokat_db`.`varaus`.`varaus` AS `varaus`,`luokat_db`.`kurssit`.`nimi` AS `kurssi`,`luokat_db`.`varaus`.`oppi_aine` AS `aihe`,`luokat_db`.`tilat`.`nimi` AS `tila`,`luokat_db`.`kouluttajat`.`nimi` AS `kouluttaja` from (((`luokat_db`.`varaus` join `luokat_db`.`kouluttajat` on((`luokat_db`.`varaus`.`kouluttaja_id` = `luokat_db`.`kouluttajat`.`id`))) join `luokat_db`.`kurssit` on((`luokat_db`.`varaus`.`kurssi_id` = `luokat_db`.`kurssit`.`id`))) join `luokat_db`.`tilat` on((`luokat_db`.`varaus`.`tila_id` = `luokat_db`.`tilat`.`id`)))
