package com.eShopping.wineseller.util;

import android.os.Environment;

/**
 * 公共变量
 * 
 * @author ty
 * @time 2015/5/12
 */
public class Constants {

	public static int onceCount = 80;
	// 屏幕宽高
	public static int ScreenWidth = 0;
	public static int ScreenHeight = 0;
	// apk版本
	public static String mCurVersion = null;
	public static String mNewVersion = null;
	public static String mNewPath = null;

	// 是否登录标识 "100000"表示未登录
	public static String mUserId = "100000";
	public static String mUserName = "游客";
	public static String mDefaultId = "100000";
	public static String mUserPwd = "";
	public static String mAccount = "100000";

	// sharedPreference
	public static String mSpLogin = "login_sp";
	public static String mSpUser = "sp_user";

	// 配置服务器地址
	//public static String netAddr = "http://222.187.226.10:803";
	public static String netAddr = "http://jiuyiti.zrcase.com";
	public static String ReturnUrl = "http://m.alipay.com";
	public static String appRootAddr = Environment.getExternalStorageDirectory().getAbsolutePath()
			+ "/eWineSeller/";
	public static String mImgPath = Constants.appRootAddr + "img/";

	// 登录
	public static String CommercialUserLogin = "/api/CommercialUserLogin";
	// 提货接口
	public static String TakeGoods = "/api/TakeGoods";
	// 修改用户信息
	public static String ChangeCommercialInfo = "/api/ChangeCommercialInfo";

	// 商户信息接口
	public static String GetCommercialUser = "/api/GetCommercialUser";
	// 查询商户库存
	public static String Commoditystock = "/api/Commoditystock";
	// 查询商户收益
	public static String CommercialProfit = "/api/CommercialProfit";
	// 查询商户收益统计
	public static String CommercialProfitTotal = "/api/CommercialProfitTotal";
	// 向后台申请推送消息到用户
	public static String PushMessage = "/api/PushMessage";
	// 查询推送消息列表
	//public static String PushMessageList = "/api/PushMessageList";
	// 修改商户登录状态
	public static String ChangeCommercialLoginState = "/api/ChangeCommercialLoginState";
	// 查询提单记录
	public static String pickUpList = "/api/pickUpList";
	// 提现记录
	public static String PickUpMoneyList = "/api/PickUpMoneyList";
	// 申请提现
	public static String AddPickUpMoney = "/api/AddPickUpMoney";
	// 升级接口
	public static String AppUpgrade = "/api/AppUpgrade";
}
