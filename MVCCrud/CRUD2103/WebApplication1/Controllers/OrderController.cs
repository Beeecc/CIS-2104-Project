using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using WebApplication1.Models;

namespace WebApplication1.Controllers
{
    public class OrderController : Controller
    {
        // GET: Order
        public ActionResult Index()
        {
            using (DBModels db = new DBModels())
            {
                return View(db.Orders.ToList());
            }
        }

        // GET: Order/Details/5
        public ActionResult Details(int id)
        {
            return View();
        }

        public ActionResult Itemins()
        {
            using (DBModels db = new DBModels())
            {
                var items = db.Items.ToList();
                if (items != null)
                {
                    ViewBag.data = items;
                }
            }
            return View();
        }
        // GET: Order/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: Order/Create
        [HttpPost]
        public ActionResult Create(Order order)
        {
            try
            {
                // TODO: Add insert logic here
                using (DBModels db = new DBModels())
                {
                    var orderDetails = db.Orders.Where(x => x.OrderItem == order.OrderItem).ToList();
                    int temp;         
                    if (orderDetails.Count > 0)
                    {
                        order.OrderUserID = Convert.ToInt32(Session["userid"]);
                        order.Status = "Pending";
                        db.Orders.Add(order);
                        Item i = (from x in db.Items
                                  where order.OrderItem == x.ItemName
                                  select x).FirstOrDefault();
                        temp = int.Parse(i.Amount);
                        temp = temp - int.Parse(order.Amount);
                        if (temp > 0)
                        {
                            i.Amount = temp.ToString();
                            db.SaveChanges();
                        }
                        else
                        {
                            ViewBag.DuplicateMessage = "Item is out of stock.";
                            return View("Create", order);
                        }
                    }
                    else
                    {
                        ViewBag.DuplicateMessage = "Item does not exist.";
                        return View("Create", order);
                    }
                }
                return RedirectToAction("Index");
            }
            catch
            {
                return View();
            }
        }

        // GET: Order/Edit/5
        public ActionResult Edit(int id)
        {
            using (DBModels db = new DBModels())
            {
                return View(db.Orders.Where(x => x.OrderID == id).FirstOrDefault()); ;
            }
        }

        // POST: Order/Edit/5
        [HttpPost]
        public ActionResult Edit(int id, Order order)
        {
            try
            {
                // TODO: Add update logic here
                using (DBModels db = new DBModels())
                {
                    order.OrderUserID = Convert.ToInt32(Session["userid"]);
                    order.Status = "Pending";
                    db.Entry(order).State = System.Data.Entity.EntityState.Modified;
                    db.SaveChanges();
                }
                return RedirectToAction("Index");
            }
            catch
            {
                return View();
            }
        }

        // GET: Order/Delete/5
        public ActionResult Delete(int id)
        {
            using (DBModels db = new DBModels())
            {
                return View(db.Orders.Where(x => x.OrderID == id).FirstOrDefault()); ;
            }
        }

        // POST: Order/Delete/5
        [HttpPost]
        public ActionResult Delete(int id, Order order)
        {
            try
            {
                // TODO: Add delete logic here
                using (DBModels db = new DBModels())
                {
                    order = db.Orders.Where(x => x.OrderID == id).FirstOrDefault();
                    db.Orders.Remove(order);
                    db.SaveChanges();
                }
                return RedirectToAction("Index");
            }
            catch
            {
                return View();
            }
        }
    }
}
