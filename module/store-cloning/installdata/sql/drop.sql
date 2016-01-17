# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v5.2.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          Project1.dez                                    #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2012-02-10 18:14                                #
# Model version:         Version 2012-02-10                              #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `ClonedStoreCategory` DROP FOREIGN KEY `ClonedStore_ClonedStoreCategory`;

ALTER TABLE `ClonedStoreCategory` DROP FOREIGN KEY `Category_ClonedStoreCategory`;

ALTER TABLE `ClonedStoreRule` DROP FOREIGN KEY `ClonedStore_ClonedStoreRule`;

# ---------------------------------------------------------------------- #
# Drop table "ClonedStore"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ClonedStore` MODIFY `ID` INTEGER UNSIGNED NOT NULL;

# Drop constraints #

ALTER TABLE `ClonedStore` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ClonedStore`;

# ---------------------------------------------------------------------- #
# Drop table "ClonedStoreCategory"                                       #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ClonedStoreCategory` MODIFY `ID` INTEGER UNSIGNED NOT NULL;

# Drop constraints #

ALTER TABLE `ClonedStoreCategory` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ClonedStoreCategory`;

# ---------------------------------------------------------------------- #
# Drop table "ClonedStoreRule"                                           #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ClonedStoreRule` MODIFY `ID` INTEGER UNSIGNED NOT NULL;

# Drop constraints #

ALTER TABLE `ClonedStoreRule` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ClonedStoreRule`;
