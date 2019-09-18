<?php 
	class Constants{
		public static $SELECT_ALL_CUSTOMER = "select * from customer";
		public static $FULLNAME = "fullName";
		public static $EMAIL = "email";
		public static $BIRTHDAY = "birthDate";
		public static $PHONENUMBER = "phoneNumber";
		public static $GENDER = "gender";
		public static $PASSWORD = "password";
		public static $CPASSWORD = "cpassword";
		public static $OPASSWORD = "oldpassword";
		public static $STATUS_ERROR_CHANGEPASSWORD = "Fail! Current password is difference from your current password";
		public static $STATUS_SUCCESS_CHANGEPASSWORD = "Update Success! ";
		public static $PAGENUM = 4;
		public static $GENDER_MEN = "men";
		public static $GENDER_WOMEN = "women";
		public static $CATEGORY_BACKPACK = "backpack";
		public static $CATEGORY_HANDBAG = "handbag";
		public static $CATEGORY_ALL = "all";
		public static $PRODUCT_CATEGORY = "product_category";
		public static $PRODUCT_GENDER = "product_gender";
		public static $PAGINATION_URL_CATEGORY = "category=";
		public static $PAGINATION_URL_GENDER = "gender=";
		public static $PAGINATION_URL_SORT = "sort=";
		public static $SORT_PORPULARITY = 1;
		public static $SORT_PRICE_LOW_HIGH = 2;
		public static $SORT_PRICE_HIGH_LOW = 3;
	}
 ?>