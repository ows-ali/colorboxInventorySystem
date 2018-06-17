# COLORBOX-Inventory Management System
----
**COLORBOX** is an Inventory Management System for managing the sales of boxes of cloth's threads/shades using Barcode technology. This project can generate and scan **Code128 Barcodes** labels.

### Features!
This project has the following features/functionalities:

* It has the ability to manage customers, salesmen and orders from pending to delivery status
* It can generate multiple barcodes on a single click just by entering the quantity
* An interactive way to add, retrieve and track history of the inventory
* On Dashboard, it shows the current number of pending orders of current month
* It also shows the progrss of orders delivered on yearly basis for the management level purposes.
* It sends a notification when a shade quantity drops from a defined limit which can be removed by clicking on it
* It is a comperhensive and ready to use inventory management system for shades/threads boxes

This project mainly uses the following technologies:

1.  PHP 5.6 with Yii 2 Framework
2.  A 1-D Scanner and a GK88t Zebra Printer with kit
3.  MySQL database server
4.  AdminLTE/Bootstrap on Frontend
5.  Javascript
6.  JQuery
7.  AJAX
8.  Libraries/Extensions/Helpers of Yii 2 including ArrayHelper, mpdf class, chartjs, gii, datetimepicker, swiftmailer etc.



### Snapshots
Dashboard : ![picture alt](backend/web/img/dashboard.PNG "Dasboard")
Adding Inventory : ![picture alt](backend/web/img/addingInventory.PNG "Adding Inventory")
Inventory History : ![picture alt](backend/web/img/inventoryHistory.PNG "Inventory History")
Barcode Labels PDF: ![picture alt](backend/web/img/barcodeLabels.PNG "Barcode Labels")
Packing List : ![picture alt](backend/web/img/packingList.PNG "Packing List")
Notifications : ![picture alt](backend/web/img/notifications.PNG "Notifications")

### Pre-requisites

This project works perfectly fine with following:
PHP version 5.6.30
Yii2 version 2.0.15.1 and 10.1.21-MariaDB

## Getting Started:
1. Clone this repository by `git clone https://github.com/owaisalics/coloboxInventorySystem.git` 
2. Run the SQL file named db-file.sql located in db directory (It will generate a Database with name "colorbox", create the tables and populate the tables)
3. Run `composer install` in the root directory to install the required libraries.
4. Make sure the xampp (Apache and Mysql servers) are running
5. Go to `localhost/directory_name/backend/web`
6. Enjoy!

(You are most welcome to comments, complaints, suggestions or get in touch with me if you have any issues in setting up)

### Roles:
#####  1. Inventory Operator
* He can generate/print the barcode labels using **GK888t Zebra Printer** to paste on the threads/shades boxes.
* He can scan those boxes to enter the items in the inventory.
* He can view the history of inventory in and out dates.

##### 2. Order Operator/Salesman
* Order Operator can create orders for customers with Pending Status.
* Order Operator can pack the order by scanning out inventory items using **linear barcode scanner** and send the request to admin for approval.
* Order Operator can print the Packing List in PDF which is sent with the order of customer and is signed by the customer as acknowledgement.

##### 3. Admin
* Admin can do everything which Inventory Operator and Order Operator can do.
* Admin can also approve the order for dispatching.
* Admin can mark the order as delivered on acknowledgement from customer.
* Admin can add new Salesman and Customers in the system.
* Admin can cancel orders.

Login Credentials
-----------------
You can use following credentials to login for different roles:

Admin Username: `admin`
Password: `qwe1234`

Inventory Operator Username: `inventory_operator`
Password: `qwe1234`

Order Operator Username: `order_operator`
Password: `qwe1234`

----

Free Software.
Open for suggestions.
By, [Owais Ali](https://github.com/owaisalics)
