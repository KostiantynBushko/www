# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v5.2.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          Project1.dez                                    #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2012-02-10 18:14                                #
# Model version:         Version 2012-02-10                              #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Tables                                                                 #
# ---------------------------------------------------------------------- #

ALTER TABLE `Product` ADD `custom` TEXT NOT NULL ;

# ---------------------------------------------------------------------- #
# Add table "ClonedStore"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `ClonedStore` (
    `ID` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `domain` VARCHAR(40),
    `apiKey` VARCHAR(40),
    CONSTRAINT `PK_ClonedStore` PRIMARY KEY (`ID`)
)
 ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;;

ALTER TABLE `ClonedStore` ADD `lastImport` TIMESTAMP NOT NULL ;

# ---------------------------------------------------------------------- #
# Add table "ClonedStoreCategory"                                        #
# ---------------------------------------------------------------------- #

CREATE TABLE `ClonedStoreCategory` (
    `ID` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `storeID` INTEGER UNSIGNED,
    `categoryID` INTEGER UNSIGNED,
    CONSTRAINT `PK_ClonedStoreCategory` PRIMARY KEY (`ID`)
)
 ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;;

# ---------------------------------------------------------------------- #
# Add table "ClonedStoreRule"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `ClonedStoreRule` (
    `ID` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `storeID` INTEGER UNSIGNED,
    `type` INTEGER,
    `entity` VARCHAR(40),
    `field` VARCHAR(40),
    `query` TEXT,
    `find` VARCHAR(100),
    `repl` VARCHAR(100),
    CONSTRAINT `PK_ClonedStoreRule` PRIMARY KEY (`ID`)
)
 ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;;

# ---------------------------------------------------------------------- #
# Foreign key constraints                                                #
# ---------------------------------------------------------------------- #

ALTER TABLE `ClonedStoreCategory` ADD CONSTRAINT `ClonedStore_ClonedStoreCategory`
    FOREIGN KEY (`storeID`) REFERENCES `ClonedStore` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ClonedStoreCategory` ADD CONSTRAINT `Category_ClonedStoreCategory`
    FOREIGN KEY (`categoryID`) REFERENCES `Category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ClonedStoreRule` ADD CONSTRAINT `ClonedStore_ClonedStoreRule`
    FOREIGN KEY (`storeID`) REFERENCES `ClonedStore` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

######### triggers ############
ALTER TABLE `AccessControlAssociation` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `AccessControlAssociation` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_AccessControlAssociation_trigger` BEFORE UPDATE ON `AccessControlAssociation`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `BackendToolbarItem` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `BackendToolbarItem` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_BackendToolbarItem_trigger` BEFORE UPDATE ON `BackendToolbarItem`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `BillingAddress` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `BillingAddress` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_BillingAddress_trigger` BEFORE UPDATE ON `BillingAddress`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Category` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Category` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Category_trigger` BEFORE UPDATE ON `Category`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `CategoryImage` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `CategoryImage` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_CategoryImage_trigger` BEFORE UPDATE ON `CategoryImage`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `CategoryPresentation` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `CategoryPresentation` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_CategoryPresentation_trigger` BEFORE UPDATE ON `CategoryPresentation`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `CategoryRelationship` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `CategoryRelationship` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_CategoryRelationship_trigger` BEFORE UPDATE ON `CategoryRelationship`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ClonedStore` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ClonedStore` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ClonedStore_trigger` BEFORE UPDATE ON `ClonedStore`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ClonedStoreCategory` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ClonedStoreCategory` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ClonedStoreCategory_trigger` BEFORE UPDATE ON `ClonedStoreCategory`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ClonedStoreRule` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ClonedStoreRule` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ClonedStoreRule_trigger` BEFORE UPDATE ON `ClonedStoreRule`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Currency` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Currency` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Currency_trigger` BEFORE UPDATE ON `Currency`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `CustomerOrder` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `CustomerOrder` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_CustomerOrder_trigger` BEFORE UPDATE ON `CustomerOrder`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DeliveryZone` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DeliveryZone` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DeliveryZone_trigger` BEFORE UPDATE ON `DeliveryZone`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DeliveryZoneAddressMask` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DeliveryZoneAddressMask` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DeliveryZoneAddressMask_trigger` BEFORE UPDATE ON `DeliveryZoneAddressMask`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DeliveryZoneCityMask` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DeliveryZoneCityMask` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DeliveryZoneCityMask_trigger` BEFORE UPDATE ON `DeliveryZoneCityMask`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DeliveryZoneCountry` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DeliveryZoneCountry` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DeliveryZoneCountry_trigger` BEFORE UPDATE ON `DeliveryZoneCountry`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DeliveryZoneRealTimeService` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DeliveryZoneRealTimeService` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DeliveryZoneRealTimeService_trigger` BEFORE UPDATE ON `DeliveryZoneRealTimeService`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DeliveryZoneState` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DeliveryZoneState` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DeliveryZoneState_trigger` BEFORE UPDATE ON `DeliveryZoneState`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DeliveryZoneZipMask` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DeliveryZoneZipMask` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DeliveryZoneZipMask_trigger` BEFORE UPDATE ON `DeliveryZoneZipMask`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Discount` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Discount` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Discount_trigger` BEFORE UPDATE ON `Discount`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DiscountAction` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DiscountAction` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DiscountAction_trigger` BEFORE UPDATE ON `DiscountAction`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DiscountCondition` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DiscountCondition` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DiscountCondition_trigger` BEFORE UPDATE ON `DiscountCondition`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `DiscountConditionRecord` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `DiscountConditionRecord` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_DiscountConditionRecord_trigger` BEFORE UPDATE ON `DiscountConditionRecord`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `EavDateValue` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `EavDateValue` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_EavDateValue_trigger` BEFORE UPDATE ON `EavDateValue`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `EavField` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `EavField` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_EavField_trigger` BEFORE UPDATE ON `EavField`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `EavFieldGroup` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `EavFieldGroup` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_EavFieldGroup_trigger` BEFORE UPDATE ON `EavFieldGroup`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `EavItem` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `EavItem` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_EavItem_trigger` BEFORE UPDATE ON `EavItem`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `EavNumericValue` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `EavNumericValue` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_EavNumericValue_trigger` BEFORE UPDATE ON `EavNumericValue`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `EavObject` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `EavObject` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_EavObject_trigger` BEFORE UPDATE ON `EavObject`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `EavStringValue` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `EavStringValue` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_EavStringValue_trigger` BEFORE UPDATE ON `EavStringValue`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `EavValue` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `EavValue` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_EavValue_trigger` BEFORE UPDATE ON `EavValue`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ExpressCheckout` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ExpressCheckout` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ExpressCheckout_trigger` BEFORE UPDATE ON `ExpressCheckout`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Filter` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Filter` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Filter_trigger` BEFORE UPDATE ON `Filter`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `FilterGroup` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `FilterGroup` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_FilterGroup_trigger` BEFORE UPDATE ON `FilterGroup`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `HelpComment` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `HelpComment` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_HelpComment_trigger` BEFORE UPDATE ON `HelpComment`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Language` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Language` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Language_trigger` BEFORE UPDATE ON `Language`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Manufacturer` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Manufacturer` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Manufacturer_trigger` BEFORE UPDATE ON `Manufacturer`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ManufacturerImage` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ManufacturerImage` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ManufacturerImage_trigger` BEFORE UPDATE ON `ManufacturerImage`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `NewsPost` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `NewsPost` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_NewsPost_trigger` BEFORE UPDATE ON `NewsPost`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `NewsletterMessage` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `NewsletterMessage` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_NewsletterMessage_trigger` BEFORE UPDATE ON `NewsletterMessage`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `NewsletterSentMessage` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `NewsletterSentMessage` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_NewsletterSentMessage_trigger` BEFORE UPDATE ON `NewsletterSentMessage`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `NewsletterSubscriber` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `NewsletterSubscriber` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_NewsletterSubscriber_trigger` BEFORE UPDATE ON `NewsletterSubscriber`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `OrderCoupon` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `OrderCoupon` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_OrderCoupon_trigger` BEFORE UPDATE ON `OrderCoupon`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `OrderDiscount` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `OrderDiscount` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_OrderDiscount_trigger` BEFORE UPDATE ON `OrderDiscount`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `OrderLog` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `OrderLog` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_OrderLog_trigger` BEFORE UPDATE ON `OrderLog`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `OrderNote` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `OrderNote` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_OrderNote_trigger` BEFORE UPDATE ON `OrderNote`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `OrderedFile` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `OrderedFile` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_OrderedFile_trigger` BEFORE UPDATE ON `OrderedFile`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `OrderedItem` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `OrderedItem` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_OrderedItem_trigger` BEFORE UPDATE ON `OrderedItem`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `OrderedItemOption` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `OrderedItemOption` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_OrderedItemOption_trigger` BEFORE UPDATE ON `OrderedItemOption`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `PostalCode` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `PostalCode` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_PostalCode_trigger` BEFORE UPDATE ON `PostalCode`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Product` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Product` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Product_trigger` BEFORE UPDATE ON `Product`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductBundle` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductBundle` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductBundle_trigger` BEFORE UPDATE ON `ProductBundle`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductCategory` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductCategory` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductCategory_trigger` BEFORE UPDATE ON `ProductCategory`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductFile` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductFile` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductFile_trigger` BEFORE UPDATE ON `ProductFile`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductFileGroup` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductFileGroup` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductFileGroup_trigger` BEFORE UPDATE ON `ProductFileGroup`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductImage` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductImage` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductImage_trigger` BEFORE UPDATE ON `ProductImage`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductList` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductList` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductList_trigger` BEFORE UPDATE ON `ProductList`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductListItem` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductListItem` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductListItem_trigger` BEFORE UPDATE ON `ProductListItem`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductOption` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductOption` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductOption_trigger` BEFORE UPDATE ON `ProductOption`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductOptionChoice` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductOptionChoice` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductOptionChoice_trigger` BEFORE UPDATE ON `ProductOptionChoice`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductPrice` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductPrice` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductPrice_trigger` BEFORE UPDATE ON `ProductPrice`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductRating` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductRating` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductRating_trigger` BEFORE UPDATE ON `ProductRating`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductRatingSummary` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductRatingSummary` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductRatingSummary_trigger` BEFORE UPDATE ON `ProductRatingSummary`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductRatingType` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductRatingType` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductRatingType_trigger` BEFORE UPDATE ON `ProductRatingType`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductRelationship` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductRelationship` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductRelationship_trigger` BEFORE UPDATE ON `ProductRelationship`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductRelationshipGroup` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductRelationshipGroup` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductRelationshipGroup_trigger` BEFORE UPDATE ON `ProductRelationshipGroup`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductReview` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductReview` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductReview_trigger` BEFORE UPDATE ON `ProductReview`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductVariation` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductVariation` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductVariation_trigger` BEFORE UPDATE ON `ProductVariation`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductVariationTemplate` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductVariationTemplate` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductVariationTemplate_trigger` BEFORE UPDATE ON `ProductVariationTemplate`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductVariationType` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductVariationType` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductVariationType_trigger` BEFORE UPDATE ON `ProductVariationType`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ProductVariationValue` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ProductVariationValue` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ProductVariationValue_trigger` BEFORE UPDATE ON `ProductVariationValue`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `RecurringProductPeriod` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `RecurringProductPeriod` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_RecurringProductPeriod_trigger` BEFORE UPDATE ON `RecurringProductPeriod`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Role` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Role` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Role_trigger` BEFORE UPDATE ON `Role`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SearchLog` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SearchLog` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SearchLog_trigger` BEFORE UPDATE ON `SearchLog`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SearchableItem` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SearchableItem` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SearchableItem_trigger` BEFORE UPDATE ON `SearchableItem`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SessionData` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SessionData` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SessionData_trigger` BEFORE UPDATE ON `SessionData`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Shipment` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Shipment` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Shipment_trigger` BEFORE UPDATE ON `Shipment`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ShipmentTax` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ShipmentTax` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ShipmentTax_trigger` BEFORE UPDATE ON `ShipmentTax`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ShippingAddress` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ShippingAddress` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ShippingAddress_trigger` BEFORE UPDATE ON `ShippingAddress`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ShippingClass` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ShippingClass` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ShippingClass_trigger` BEFORE UPDATE ON `ShippingClass`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ShippingRate` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ShippingRate` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ShippingRate_trigger` BEFORE UPDATE ON `ShippingRate`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `ShippingService` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `ShippingService` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_ShippingService_trigger` BEFORE UPDATE ON `ShippingService`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SpecField` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SpecField` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SpecField_trigger` BEFORE UPDATE ON `SpecField`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SpecFieldGroup` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SpecFieldGroup` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SpecFieldGroup_trigger` BEFORE UPDATE ON `SpecFieldGroup`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SpecFieldValue` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SpecFieldValue` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SpecFieldValue_trigger` BEFORE UPDATE ON `SpecFieldValue`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SpecificationDateValue` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SpecificationDateValue` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SpecificationDateValue_trigger` BEFORE UPDATE ON `SpecificationDateValue`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SpecificationItem` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SpecificationItem` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SpecificationItem_trigger` BEFORE UPDATE ON `SpecificationItem`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SpecificationNumericValue` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SpecificationNumericValue` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SpecificationNumericValue_trigger` BEFORE UPDATE ON `SpecificationNumericValue`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `SpecificationStringValue` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `SpecificationStringValue` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_SpecificationStringValue_trigger` BEFORE UPDATE ON `SpecificationStringValue`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `State` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `State` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_State_trigger` BEFORE UPDATE ON `State`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `StaticPage` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `StaticPage` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_StaticPage_trigger` BEFORE UPDATE ON `StaticPage`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Tax` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Tax` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Tax_trigger` BEFORE UPDATE ON `Tax`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `TaxClass` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `TaxClass` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_TaxClass_trigger` BEFORE UPDATE ON `TaxClass`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `TaxRate` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `TaxRate` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_TaxRate_trigger` BEFORE UPDATE ON `TaxRate`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `Transaction` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `Transaction` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_Transaction_trigger` BEFORE UPDATE ON `Transaction`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `User` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `User` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_User_trigger` BEFORE UPDATE ON `User`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `UserAddress` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `UserAddress` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_UserAddress_trigger` BEFORE UPDATE ON `UserAddress`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
ALTER TABLE `UserGroup` ADD `lastModifiedTime` TIMESTAMP;
ALTER TABLE `UserGroup` ADD `protectedFields` TEXT;
# CREATE TRIGGER `update_UserGroup_trigger` BEFORE UPDATE ON `UserGroup`  FOR EACH ROW SET NEW.`lastModifiedTime` = NOW();
