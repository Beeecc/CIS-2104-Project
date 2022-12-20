using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using WebApplication1.Models;

namespace WebApplication1.Controllers
{
    public class LoginController : Controller
    {
        // GET: Login
        public ActionResult Index()
        {
            return View();
        }
        [HttpPost]
        public ActionResult Authorize(User user)
        {
            using (DBModels db = new DBModels())
            {
                var userDetails = db.Users.Where(x => x.Username == user.Username && x.Password == user.Password).ToList();
                if (userDetails.Count > 0)
                {
                    // Get the first record (since we are using FirstOrDefault)
                    var userDetail = userDetails.FirstOrDefault();
                    // Store the value in a variable
                    int ID = userDetail.UserID;
                    String role = userDetail.Role;
                    if (role == "Buyer")
                    {
                        Session["userID"] = ID;
                        return RedirectToAction("Index", "Buyer");
                    } else if (role == "Seller")
                    {
                        Session["userID"] = ID;
                        return RedirectToAction("Index", "Item");
                    } else
                    {
                        Session["userID"] = ID;
                        return RedirectToAction("Index", "Admin");
                    }
                }
                else
                {
                    user.LoginErrorMsg = "Account does not exist.";
                    return View("Index", user);
                }
            }
        }
        public ActionResult Logout()
        {
            Session.Abandon();
            return RedirectToAction("Index", "Login");
        }
    }
}