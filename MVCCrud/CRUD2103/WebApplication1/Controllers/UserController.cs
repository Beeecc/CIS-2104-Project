using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using WebApplication1.Models;

namespace WebApplication1.Controllers
{
    public class UserController : Controller
    {
        // GET: UserRegistration
        public ActionResult AddOrEdit(int id = 0)
        {
            User user = new User();
            return View(user);
        }
        [HttpPost]
        public ActionResult AddOrEdit(User user)
        {
            user.Role = "Buyer";
            using (DBModels db = new DBModels())
            {
                if (db.Users.Any(x => x.Username == user.Username))
                {
                    ViewBag.DuplicateMessage = "Username already exists.";
                    return View("AddOrEdit", user);
                }
                else
                {
                    db.Users.Add(user);
                    db.SaveChanges();
                }
            }
            ModelState.Clear();
            ViewBag.SuccessMessage = "Registration successful!";
            return View("AddORedit", new User());
        }
    }
}