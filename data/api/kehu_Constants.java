package com.eShopping.wine.util;

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
	public static String mAccount = "";

	// sharedPreference
	public static String mSpLogin = "login_sp";
	public static String mSpUser = "sp_user";

	// 2G下载标志
	public static Boolean mNet2GDown = false;

	// 配置服务器地址
	//public static String netAddr = "http://222.187.226.10:803";
	public static String netAddr = "http://jiuyiti.zrcase.com";
	public static String ReturnUrl = "http://m.alipay.com";
	public static String appRootAddr = Environment.getExternalStorageDirectory().getAbsolutePath()
			+ "/eWine/";
	public static String mImgPath = Constants.appRootAddr + "img/";

	// 登录
	public static String Login = "/api/Login";
	// 注册
	public static String Addmemberuser = "/api/Addmemberuser";
	// 检查账号是否注册
	public static String VerifyAccount = "/api/VerifyAccount";
	// 修改用户信息
	public static String Editmemberuser = "/api/Editmemberuser";

	// 查询所有商品
	public static String GetCommodity = "/api/GetCommodity";
	// 根据商戶ID查询商品
	public static String GetCommoditybysh = "/api/GetCommoditybysh";

	// 订单生成
	public static String AddOrderForm = "/api/AddOrderForm";
	// 订单修改
	//public static String EditOrderForm = "/api/EditOrderForm";
	// 添加消费记录
	//public static String AddExpense = "/api/AddExpense";
	// 修改消费记录
	//public static String EditExpense = "/api/EditExpense";
	// 添加评论
	//public static String Addcomment = "/api/Addcomment";
	// 修改评论
	//public static String Editcomment = "/api/Editcomment";
	// 删除评论
	//public static String Deltcomment = "/api/Deltcomment";
	// 添加浏览记录
	public static String Addbrowsing = "/api/Addbrowsing";
	// 修改浏览记录
	//public static String Editbrowsing = "/api/Editbrowsing";
	// 删除浏览记录
	//public static String Deltabrowsing = "/api/Deltabrowsing";
	// 添加收藏
	public static String Addcollect = "/api/Addcollect";
	// 修改收藏
	//public static String Editcollect = "/api/Editcollect";
	// 删除收藏
	public static String Deltcollect = "/api/Deltcollect";
	// 添加购物车
	public static String Addshoppingcart = "/api/Addshoppingcart";
	// 修改购物车
	//public static String Editshoppingcart = "/api/Editshoppingcart";
	// 删除购物车
	//public static String DelShoppingCart = "/api/DelShoppingCart";
	// 文件上传
	//public static String uploadFile = "/api/uploadFile";
	// 订单列表
	public static String orderList = "/api/orderList";
	// 获取商户信息
	//public static String GetCommercialUser = "/api/GetCommercialUser";
	// 浏览记录
	public static String BrowsingList = "/api/BrowsingList";
	// 收藏记录
	public static String CollectList = "/api/CollectList";
	// 版本信息
	//public static String appversion = "/api/appversion";
	// 评论列表
	//public static String CommentList = "/api/CommentList";

	// 根据商品ID获得详情
	public static String GetCommodityById = "/api/GetCommodityById";
	// 修改用户密码
	//public static String ChangeMemberUserPwd = "/api/ChangeMemberUserPwd";
	// 购物车列表
	public static String ShoppingCartList = "/api/ShoppingCartList";
	// 活动列表
	public static String ActivityList = "/api/ActivityList";
	// 修改订单状态
	public static String ChangeOrderState = "/api/ChangeOrderState";
	// 获取短信验证码接口
	public static String GetSmsVerify = "/api/GetSmsVerify";
	// 自定义发送短信
	//public static String SendSms = "/api/SendSms";
	// 按照经纬度排序获取商家信息
	public static String TBList = "/api/TBList";
	// 获取二维码地址接口
	public static String GetQRCode = "/api/GetQRCode";
	// 商品类别列表接口
	public static String CommodityClassList = "/api/CommodityClassList";
	// 订单完成
	public static String OrderPay = "/api/OrderPay";
	// 设置设备码接口--消息推送
	public static String AddDevice = "/api/AddDevice";
	// 删除订单
	public static String deleteorder = "/api/deleteorder";
	// 查询用户信息接口
	public static String MemberUserInfo = "/api/MemberUserInfo";
	// 更新用户酒钱
	public static String editUserJiuQian = "/api/editUserJiuQian";
	// 获取商品详情
	public static String CommodityDetails = "/Commodity/CommodityDetails";
	// 升级接口
	public static String AppUpgrade = "/api/AppUpgrade";

	// 联系我们
	public static String ContactUs = "/api/ContactUs";
	// 我要加盟
	public static String AddJoin = "/api/AddJoin";
	// 加盟优势
	public static String JoinYouShi = "/join/joinTJYS?id=1";
	// 加盟条件
	public static String JoinTiaoJian = "/join/joinTJYS?id=2";
}
