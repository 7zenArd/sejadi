## 📋 Dokumentasi API - AdminDashboard.vue
```
=================================================
ADMIN DASHBOARD PAGE - API DOCUMENTATION
=================================================

1. Get Store Status (Cafe Open/Close)
-------------------------------------------------
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/cafe_settings
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
query       : ?select=is_open&limit=1
response    : 200 {
                "is_open": true
              }
              400 { "error": "Bad Request" }
              404 { "code": "PGRST116", "message": "No rows found" }
              500 { "error": "Internal Server Error" }

2. Insert Store Status (First Time Setup)
-------------------------------------------------
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/cafe_settings
method      : POST
payload     : [
                {
                  "is_open": true
                }
              ]
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 201 {
                "id": 1,
                "is_open": true,
                "created_at": "2025-01-15T10:30:00Z"
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

3. Update Store Status (Open/Close Cafe)
-------------------------------------------------
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/cafe_settings
method      : PATCH
payload     : {
                "is_open": false,
                "updated_at": "2025-01-15T10:30:00Z"
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
query       : ?id=eq.{id}
response    : 200 {
                "id": 1,
                "is_open": false,
                "updated_at": "2025-01-15T10:30:00Z"
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

4. Get Total Menu Count
-------------------------------------------------
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Prefer": "count=exact"
              }
query       : ?select=id
response    : 200 (Headers: Content-Range: 0-49/50)
              Count extracted from header
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

5. Get Total Kategori Count
-------------------------------------------------
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/kategori_menu
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Prefer": "count=exact"
              }
query       : ?select=id
response    : 200 (Headers: Content-Range: 0-9/10)
              Count extracted from header
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

6. Get Today's Orders Count
-------------------------------------------------
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/pesanan
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Prefer": "count=exact"
              }
query       : ?select=id&created_at=gte.2025-01-15T00:00:00.000Z
response    : 200 (Headers: Content-Range: 0-29/30)
              Count extracted from header
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

7. Get Orders Count by Status
-------------------------------------------------
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/pesanan
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Prefer": "count=exact"
              }
query       : ?select=id&status=eq.pending
              (status values: "pending", "diproses", "selesai")
response    : 200 (Headers: Content-Range: 0-4/5)
              Count extracted from header
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

8. Get Active Orders with Details (Pending & Diproses)
-------------------------------------------------
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/pesanan
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
query       : ?select=id,no_meja,status,note,total,created_at,location_area,detail_pesanan(id,menu_id,jumlah,menu:menu_id(nama))&status=in.(pending,diproses)&order=created_at.desc
response    : 200 {
                "data": [
                  {
                    "id": 1,
                    "no_meja": "5",
                    "status": "pending",
                    "note": "Pedas sedang",
                    "total": 50000,
                    "created_at": "2025-01-15T10:30:00Z",
                    "location_area": "indoor",
                    "detail_pesanan": [
                      {
                        "id": 1,
                        "menu_id": 5,
                        "jumlah": 2,
                        "menu": {
                          "nama": "Kopi Susu"
                        }
                      }
                    ]
                  }
                ]
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

9. Realtime Subscribe - Store Status Changes
-------------------------------------------------
endpoint    : wss://glpdalyzhouayztwgtkv.supabase.co/realtime/v1
method      : WEBSOCKET
channel     : cafe_settings_channel
event       : * (all events: INSERT, UPDATE, DELETE)
table       : cafe_settings
schema      : public
response    : {
                "new": {
                  "id": 1,
                  "is_open": false,
                  "updated_at": "2025-01-15T10:30:00Z"
                }
              }


11. Discount Codes
-------------------------------------------------
### Get All Discount Codes
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/discount-codes
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
query       : ?select=*&code=eq.DISCOUNT10&is_active=eq.true&type=eq.percentage&min_amount=lte.100000&max_discount_amount=gte.50000&valid_from=lte.2025-01-01&valid_to=gte.2025-12-31&usage_limit=gte.10&used_count=lte.5&order=created_at.desc
response    : 200 {
                "data": [
                  {
                    "id": 1,
                    "code": "DISCOUNT10",
                    "type": "percentage",
                    "value": 10,
                    "is_active": true,
                    "min_amount": 50000,
                    "max_discount_amount": 10000,
                    "valid_from": "2025-01-01T00:00:00Z",
                    "valid_to": "2025-12-31T23:59:59Z",
                    "usage_limit": 100,
                    "used_count": 10,
                    "created_at": "2025-01-15T10:30:00Z",
                    "updated_at": "2025-01-15T10:30:00Z"
                  }
                ]
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

### Get Discount Code by ID
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/discount-codes/{id}
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 {
                "id": 1,
                "code": "DISCOUNT10",
                "type": "percentage",
                "value": 10,
                "is_active": true,
                "min_amount": 50000,
                "max_discount_amount": 10000,
                "valid_from": "2025-01-01T00:00:00Z",
                "valid_to": "2025-12-31T23:59:59Z",
                "usage_limit": 100,
                "used_count": 10,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "Discount Code not found" }
              500 { "error": "Internal Server Error" }

### Create New Discount Code
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/discount-codes
method      : POST
payload     : {
                "code": "NEWDISCOUNT",
                "type": "fixed",
                "value": 5000,
                "is_active": true,
                "min_amount": 20000,
                "max_discount_amount": null,
                "valid_from": "2025-02-01T00:00:00Z",
                "valid_to": "2025-02-28T23:59:59Z",
                "usage_limit": 50,
                "used_count": 0
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 201 {
                "id": 2,
                "code": "NEWDISCOUNT",
                "type": "fixed",
                "value": 5000,
                "is_active": true,
                "min_amount": 20000,
                "max_discount_amount": null,
                "valid_from": "2025-02-01T00:00:00Z",
                "valid_to": "2025-02-28T23:59:59Z",
                "usage_limit": 50,
                "used_count": 0,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              422 { "errors": { "code": ["The code has already been taken."] } }
              500 { "error": "Internal Server Error" }

### Update Discount Code
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/discount-codes/{id}
method      : PUT
payload     : {
                "is_active": false,
                "usage_limit": 40
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 {
                "id": 1,
                "code": "DISCOUNT10",
                "type": "percentage",
                "value": 10,
                "is_active": false,
                "min_amount": 50000,
                "max_discount_amount": 10000,
                "valid_from": "2025-01-01T00:00:00Z",
                "valid_to": "2025-12-31T23:59:59Z",
                "usage_limit": 40,
                "used_count": 10,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "Discount Code not found" }
              422 { "errors": { "code": ["The code has already been taken."] } }
              500 { "error": "Internal Server Error" }

### Delete Discount Code
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/discount-codes/{id}
method      : DELETE
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 204 { "message": "Discount Code deleted successfully" }
              404 { "error": "Discount Code not found" }
              500 { "error": "Internal Server Error" }


-------------------------------------------------

12. Export Histories
-------------------------------------------------
### Get All Export Histories
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/export-histories
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
query       : ?select=*&export_type=eq.order&status=eq.completed&user_id=eq.1&created_from=gte.2025-01-01T00:00:00Z&created_to=lte.2025-12-31T23:59:59Z&order=created_at.desc
response    : 200 {
                "data": [
                  {
                    "id": 1,
                    "export_type": "order",
                    "status": "completed",
                    "file_path": "/exports/orders/order_export_20250115.csv",
                    "user_id": 1,
                    "metadata": {"filter": "today"},
                    "created_at": "2025-01-15T10:30:00Z",
                    "updated_at": "2025-01-15T10:30:00Z"
                  }
                ]
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

### Get Export History by ID
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/export-histories/{id}
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 {
                "id": 1,
                "export_type": "order",
                "status": "completed",
                "file_path": "/exports/orders/order_export_20250115.csv",
                "user_id": 1,
                "metadata": {"filter": "today"},
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "Export History not found" }
              500 { "error": "Internal Server Error" }

### Create New Export History
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/export-histories
method      : POST
payload     : {
                "export_type": "menu",
                "status": "pending",
                "file_path": null,
                "user_id": 1,
                "metadata": {"category": "coffee"}
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 201 {
                "id": 2,
                "export_type": "menu",
                "status": "pending",
                "file_path": null,
                "user_id": 1,
                "metadata": {"category": "coffee"},
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              422 { "errors": { "export_type": ["The selected export type is invalid."] } }
              500 { "error": "Internal Server Error" }

### Update Export History
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/export-histories/{id}
method      : PUT
payload     : {
                "status": "completed",
                "file_path": "/exports/menus/menu_export_20250115.csv"
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 {
                "id": 2,
                "export_type": "menu",
                "status": "completed",
                "file_path": "/exports/menus/menu_export_20250115.csv",
                "user_id": 1,
                "metadata": {"category": "coffee"},
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "Export History not found" }
              422 { "errors": { "status": ["The selected status is invalid."] } }
              500 { "error": "Internal Server Error" }

### Delete Export History
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/export-histories/{id}
method      : DELETE
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 204 { "message": "Export History deleted successfully" }
              404 { "error": "Export History not found" }
              500 { "error": "Internal Server Error" }



13. History Archives
-------------------------------------------------
### Get All History Archives
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/history-archives
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
query       : ?select=*&archive_type=eq.order&user_id=eq.1&created_from=gte.2025-01-01T00:00:00Z&created_to=lte.2025-12-31T23:59:59Z&order=created_at.desc
response    : 200 {
                "data": [
                  {
                    "id": 1,
                    "archive_type": "order",
                    "data": {"order_id": 123, "customer_name": "John Doe"},
                    "user_id": 1,
                    "created_at": "2025-01-15T10:30:00Z",
                    "updated_at": "2025-01-15T10:30:00Z"
                  }
                ]
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

### Get History Archive by ID
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/history-archives/{id}
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 {
                "id": 1,
                "archive_type": "order",
                "data": {"order_id": 123, "customer_name": "John Doe"},
                "user_id": 1,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "History Archive not found" }
              500 { "error": "Internal Server Error" }

### Create New History Archive
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/history-archives
method      : POST
payload     : {
                "archive_type": "menu",
                "data": {"menu_id": 456, "menu_name": "Coffee Latte"},
                "user_id": 1
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 201 {
                "id": 2,
                "archive_type": "menu",
                "data": {"menu_id": 456, "menu_name": "Coffee Latte"},
                "user_id": 1,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              422 { "errors": { "archive_type": ["The selected archive type is invalid."] } }
              500 { "error": "Internal Server Error" }

              404 { "error": "History Archive not found" }
              500 { "error": "Internal Server Error" }


14. Menu Additional Configs
-------------------------------------------------

15. Menu Allowed Additionals
-------------------------------------------------
### Get All Menu Allowed Additionals
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-allowed-additionals
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
query       : ?select=*&menu_id=eq.1&additional_id=eq.1&created_from=gte.2025-01-01T00:00:00Z&created_to=lte.2025-12-31T23:59:59Z&order=created_at.desc
response    : 200 {
                "data": [
                  {
                    "id": 1,
                    "menu_id": 1,
                    "additional_id": 1,
                    "created_at": "2025-01-15T10:30:00Z",
                    "updated_at": "2025-01-15T10:30:00Z"
                  }
                ]
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

### Get Menu Allowed Additional by ID
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-allowed-additionals/{id}
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 {
                "id": 1,
                "menu_id": 1,
                "additional_id": 1,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "Menu Allowed Additionals not found" }
              500 { "error": "Internal Server Error" }

### Create New Menu Allowed Additional
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-allowed-additionals
method      : POST
payload     : {
                "menu_id": 1,
                "additional_id": 1
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 201 {
                "id": 2,
                "menu_id": 1,
                "additional_id": 1,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              422 { "errors": { "menu_id": ["The menu id field is required."] } }
              500 { "error": "Internal Server Error" }

### Update Menu Allowed Additional
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-allowed-additionals/{id}
method      : PUT
payload     : {
                "menu_id": 2
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 {
                "id": 1,
                "menu_id": 2,
                "additional_id": 1,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "Menu Allowed Additionals not found" }
              422 { "errors": { "menu_id": ["The menu id must be an integer."] } }
              500 { "error": "Internal Server Error" }

### Delete Menu Allowed Additional
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-allowed-additionals/{id}
method      : DELETE
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 204 { "message": "Menu Allowed Additionals deleted successfully" }
              404 { "error": "Menu Allowed Additionals not found" }
              500 { "error": "Internal Server Error" }
### Get All Menu Additional Configs
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-additional-configs
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
query       : ?select=*&menu_id=eq.1&additional_id=eq.1&created_from=gte.2025-01-01T00:00:00Z&created_to=lte.2025-12-31T23:59:59Z&order=created_at.desc
response    : 200 {
                "data": [
                  {
                    "id": 1,
                    "menu_id": 1,
                    "additional_id": 1,
                    "created_at": "2025-01-15T10:30:00Z",
                    "updated_at": "2025-01-15T10:30:00Z"
                  }
                ]
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

### Get Menu Additional Config by ID
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-additional-configs/{id}
method      : GET
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 {
                "id": 1,
                "menu_id": 1,
                "additional_id": 1,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "Menu Additional Config not found" }
              500 { "error": "Internal Server Error" }

### Create New Menu Additional Config
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-additional-configs
method      : POST
payload     : {
                "menu_id": 1,
                "additional_id": 1
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 201 {
                "id": 2,
                "menu_id": 1,
                "additional_id": 1,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              422 { "errors": { "menu_id": ["The menu id field is required."] } }
              500 { "error": "Internal Server Error" }

### Update Menu Additional Config
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-additional-configs/{id}
method      : PUT
payload     : {
                "menu_id": 2
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 {
                "id": 1,
                "menu_id": 2,
                "additional_id": 1,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "Menu Additional Config not found" }
              422 { "errors": { "menu_id": ["The selected menu id is invalid."] } }
              500 { "error": "Internal Server Error" }

### Delete Menu Additional Config
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/menu-additional-configs/{id}
method      : DELETE
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 204 { "message": "Menu Additional Config deleted successfully" }
              404 { "error": "Menu Additional Config not found" }
              500 { "error": "Internal Server Error" }


-------------------------------------------------

### Update History Archive
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/history-archives/{id}
method      : PUT
payload     : {
                "data": {"menu_id": 456, "menu_name": "Espresso"}
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkJXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 {
                "id": 2,
                "archive_type": "menu",
                "data": {"menu_id": 456, "menu_name": "Espresso"},
                "user_id": 1,
                "created_at": "2025-01-15T10:30:00Z",
                "updated_at": "2025-01-15T10:30:00Z"
              }
              404 { "error": "History Archive not found" }
              422 { "errors": { "data": ["The data field is required."] } }
              500 { "error": "Internal Server Error" }

### Delete History Archive
endpoint    : https://glpdalyzhouayztwgtkv.supabase.co/rest/v1/history-archives/{id}
method      : DELETE
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 204 { "message": "History Archive deleted successfully" }
              404 { "error": "History Archive not found" }
              500 { "error": "Internal Server Error" }


- Dashboard menampilkan statistik real-time
- Terdapat 2 tab: Dine-in (nomor meja angka) & Take Away (nomor meja teks)
- Orders di-filter berdasarkan status "pending" dan "diproses"
- Realtime updates untuk pesanan dan status cafe
- Admin dapat membuka/menutup cafe dari dashboard
- Location area: indoor, outdoor, teras, billiard
- Silent refresh untuk update data tanpa loading indicator


AdminOrder.vue

📋 Dokumentasi API - AdminOrder.vue
=================================================
ADMIN ORDER PAGE - API DOCUMENTATION
=================================================

1. Fetch Active Orders
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan
method      : GET
query       : select=id,no_meja,note,status,created_at,total,updated_at,location_area,detail_pesanan(id,menu_id,jumlah,subtotal,note,varian,additionals,dimsum_additionals,additional_price,base_price,menu(id,nama,harga,kategori_id,kategori_struk))
              &status=in.(pending,diproses)
              &order=created_at.desc
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 [
                {
                  "id": 1,
                  "no_meja": "12",
                  "note": "Tanpa es",
                  "status": "pending",
                  "created_at": "2025-01-20T10:30:00Z",
                  "total": 50000,
                  "updated_at": "2025-01-20T10:30:00Z",
                  "location_area": "indoor",
                  "detail_pesanan": [
                    {
                      "id": 1,
                      "menu_id": 5,
                      "jumlah": 2,
                      "subtotal": 50000,
                      "note": "Extra sugar",
                      "varian": "Ice",
                      "additionals": {"coklat-kretek": true},
                      "dimsum_additionals": null,
                      "additional_price": 7000,
                      "base_price": 25000,
                      "menu": {
                        "id": 5,
                        "nama": "Es Kopi Susu",
                        "harga": 25000,
                        "kategori_id": 1,
                        "kategori_struk": "minuman"
                      }
                    }
                  ]
                }
              ]
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

2. Update Order Status to "diproses"
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan
method      : PATCH
query       : id=eq.{order_id}
payload     : {
                "status": "diproses"
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 { "status": "success" }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

3. Cancel Order (Update to "batal")
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan
method      : PATCH
query       : id=eq.{order_id}
payload     : {
                "status": "batal",
                "updated_at": "2025-01-20T10:30:00Z",
                "cancellation_reason": "Dibatalkan oleh kasir",
                "cancelled_at": "2025-01-20T10:30:00Z"
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 { "status": "success" }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

4. Delete Order (Update Status to "batal")
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan
method      : PATCH
query       : id=eq.{order_id}
payload     : {
                "status": "batal",
                "updated_at": "2025-01-20T10:30:00Z",
                "cancellation_reason": "Dihapus oleh kasir",
                "cancelled_at": "2025-01-20T10:30:00Z"
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 { "status": "success" }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

5. Cancel Item (Partial Cancellation)
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/detail_pesanan
method      : PATCH
query       : id=eq.{item_id}&pesanan_id=eq.{order_id}
payload     : {
                "jumlah": 1,
                "jumlah_asli": 3,
                "cancelled_qty": 2,
                "cancellation_notes": "Habis",
                "cancelled_at": "2025-01-20T10:30:00Z",
                "subtotal": 25000
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 { "status": "success" }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

6. Update Total After Item Cancellation
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan
method      : PATCH
query       : id=eq.{order_id}
payload     : {
                "total": 75000,
                "updated_at": "2025-01-20T10:30:00Z"
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 { "status": "success" }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

7. Process Payment & Complete Order
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan
method      : PATCH
query       : id=eq.{order_id}
payload     : {
                "status": "selesai",
                "updated_at": "2025-01-20T10:30:00Z",
                "completed_at": "2025-01-20T10:30:00Z",
                "metode_pembayaran": "cash",
                "bank_qris": null,
                "discount_code": "PROMO10",
                "discount_amount": 5000,
                "total_after_discount": 45000
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 { "status": "success" }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

8. Fetch Discount Codes
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/discount_codes
method      : GET
query       : select=code,type,value,description,is_active
              &is_active=eq.true
              &order=id.desc
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 [
                {
                  "code": "PROMO10",
                  "type": "percent",
                  "value": 10,
                  "description": "Diskon 10%",
                  "is_active": true
                },
                {
                  "code": "DISKON5K",
                  "type": "fixed",
                  "value": 5000,
                  "description": "Diskon Rp 5.000",
                  "is_active": true
                }
              ]
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

9. Fetch Additional Menu
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/additionals
method      : GET
query       : select=id,nama,harga
              &order=nama.asc
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 [
                {
                  "id": 1,
                  "nama": "Coklat Kretek",
                  "harga": 7000
                },
                {
                  "id": 2,
                  "nama": "Oat Milk",
                  "harga": 5000
                }
              ]
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

10. Fetch Store Status
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings
method      : GET
query       : select=is_open
              &limit=1
payload     : -
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 {
                "is_open": true
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

11. Insert Default Store Status (If Not Exists)
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings
method      : POST
query       : -
payload     : [
                {
                  "is_open": true
                }
              ]
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 201 { "status": "success" }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

12. Update Store Status
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings
method      : PATCH
query       : id=eq.{cafe_settings_id}
payload     : {
                "is_open": false,
                "updated_at": "2025-01-20T10:30:00Z"
              }
header      : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 { "status": "success" }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

13. Realtime Subscribe - Store Status Updates
-
endpoint    : wss://wqsizttvrwwddquftpnq.supabase.co/realtime/v1
method      : WEBSOCKET
channel     : cafe_settings_channel_order
event       : * (INSERT, UPDATE, DELETE)
table       : cafe_settings
schema      : public
response    : {
                "new": {
                  "is_open": false,
                  "updated_at": "2025-01-20T10:30:00Z"
                }
              }

14. Get Database Timestamp from External API
-
endpoint    : https://timeapi.io/api/time/current/zone?timeZone=Asia/Jakarta
method      : GET
payload     : -
header      : {
                "Content-Type": "application/json"
              }
response    : 200 {
                "year": 2025,
                "month": 1,
                "day": 20,
                "hour": 10,
                "minute": 30,
                "seconds": 45,
                "dateTime": "2025-01-20T10:30:45.123456"
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

15. Fetch Logo Sejadi Kopi (Storage)
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/assets/Logo/logo_sejadi.png
method      : GET
payload     : -
header      : -
response    : 200 (Binary Image Data)
              404 { "error": "Not Found" }

16. Fetch Bank Logo BCA (Storage)
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/assets/Logo/BCA-Logo-Bank-Central-Asia.png
method      : GET
payload     : -
header      : -
response    : 200 (Binary Image Data)
              404 { "error": "Not Found" }

17. Fetch Bank Logo BRI (Storage)
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/assets/Logo/bri-logo-png_seeklogo-457200.png
method      : GET
payload     : -
header      : -
response    : 200 (Binary Image Data)
              404 { "error": "Not Found" }

18. Fetch Bank Logo BSI (Storage)
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/assets/Logo/bank-syariah-indonesia-logo-png_seeklogo-400984.png
method      : GET
payload     : -
header      : -
response    : 200 (Binary Image Data)
              404 { "error": "Not Found" }

19. Fetch Notification Sound (Storage)
-
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/assets/sounds/notif.mp3
method      : GET
payload     : -
header      : -
response    : 200 (Binary Audio Data)
              404 { "error": "Not Found" }

20. RawBT Printer Intent (Android)
-
endpoint    : intent:{encoded_receipt_text}#Intent;scheme=rawbt;package=ru.a402d.rawbtprinter;end
method      : ANDROID_INTENT
payload     : Encoded receipt text (URL encoded)
header      : -
response    : Opens RawBT Printer app on Android device

=================================================
CATATAN TAMBAHAN:
=================================================

1. Semua endpoint Supabase menggunakan apikey dan Authorization header
2. Realtime subscription menggunakan WebSocket untuk live updates
3. Printer menggunakan RawBT Android app dengan intent scheme
4. Payment support: CASH & QRIS (BCA, BRI, BSI)
5. Discount support: Percentage & Fixed amount
6. Location area: indoor, outdoor, teras, billiard
7. Order status: pending, diproses, selesai, batal
8. Item cancellation: partial (qty reduction) atau full (qty = 0)
9. Kategori struk: makanan (kategori_id 1-7), minuman (kategori_id 8-12)
10. Auto-refresh orders setiap 30 detik
11. New order detection dengan notification queue
12. Sound notification untuk pesanan baru

=================================================
TOTAL API ENDPOINTS: 20
- Supabase REST API: 12 endpoints
- Supabase Realtime: 1 websocket
- Supabase Storage: 5 endpoints
- External Time API: 1 endpoint
- Android Intent: 1 endpoint
=================================================


AdminHistory.vue

📋 Dokumentasi API - AdminHistory.vue
=================================================
ADMIN HISTORY PAGE - API DOCUMENTATION
=================================================
1. Fetch All Histories (Completed & Cancelled Orders)
endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan
method      : GET
params      : select=id,no_meja,note,status,created_at,updated_at,total,cancellation_reason,cancelled_at,location_area,discount_code,discount_amount,total_after_discount,metode_pembayaran,bank_qris,detail_pesanan(id,menu_id,jumlah,subtotal,note,varian,additionals,dimsum_additionals,additional_price,menu(id,nama,harga,kategori_id))
              &status=in.(selesai,batal)
              &order=updated_at.desc
headers     : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 [
                {
                  "id": 1,
                  "no_meja": "5",
                  "note": "Catatan pesanan",
                  "status": "selesai",
                  "created_at": "2024-01-01T10:00:00Z",
                  "updated_at": "2024-01-01T10:30:00Z",
                  "total": 50000,
                  "cancellation_reason": null,
                  "cancelled_at": null,
                  "location_area": "indoor",
                  "discount_code": "DISC10",
                  "discount_amount": 5000,
                  "total_after_discount": 45000,
                  "metode_pembayaran": "cash",
                  "bank_qris": null,
                  "detail_pesanan": [
                    {
                      "id": 1,
                      "menu_id": 1,
                      "jumlah": 2,
                      "subtotal": 50000,
                      "note": "Gula dikit",
                      "varian": "Ice",
                      "additionals": "{\"oat-milk\":true}",
                      "dimsum_additionals": null,
                      "additional_price": 5000,
                      "menu": {
                        "id": 1,
                        "nama": "Kopi Susu",
                        "harga": 20000,
                        "kategori_id": 1
                      }
                    }
                  ]
                }
              ]
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }


2. Fetch Cancelled Items

endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cancelled_items
method      : GET
params      : select=*
              &pesanan_id=in.(1,2,3,...)
headers     : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 [
                {
                  "id": 1,
                  "pesanan_id": 1,
                  "item_name": "Kopi Latte",
                  "cancelled_qty": 1,
                  "item_price": 25000,
                  "item_subtotal": 25000,
                  "cancellation_reason": "Stok habis",
                  "cancelled_at": "2024-01-01T10:15:00Z",
                  "varian": "Ice",
                  "additionals": "{\"oat-milk\":true}",
                  "dimsum_additionals": null
                }
              ]
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }


3. Check Cafe Status (Store Open/Close)

endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings
method      : GET
params      : select=is_open
              &limit=1
headers     : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 {
                "is_open": true
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

4. Create Initial Cafe Settings (If Not Exists)

endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings
method      : POST
payload     : {
                "is_open": true
              }
headers     : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 201 {
                "id": 1,
                "is_open": true,
                "created_at": "2024-01-01T10:00:00Z"
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

5. Check Existing Cafe Settings

endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings
method      : GET
params      : select=id
              &limit=1
headers     : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
              }
response    : 200 {
                "id": 1
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }

6. Update Cafe Status (Open/Close Store)

endpoint    : https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings
method      : PATCH
params      : id=eq.1
payload     : {
                "is_open": false,
                "updated_at": "2024-01-01T10:00:00Z"
              }
headers     : {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
                "Content-Type": "application/json"
              }
response    : 200 {
                "id": 1,
                "is_open": false,
                "updated_at": "2024-01-01T10:00:00Z"
              }
              400 { "error": "Bad Request" }
              500 { "error": "Internal Server Error" }


AdminPembukuan.vue

{
  "file": "AdminPembukuan.vue",
  "total_api_endpoints": 15,
  "apis": [
    {
      "no": 1,
      "name": "Fetch Completed Transactions for Financial Summary",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan",
      "method": "GET",
      "params": "select=total,created_at,detail_pesanan(subtotal,jumlah,menu(id,nama,kategori_id,harga,kategori_menu(id,nama)))&status=eq.selesai&created_at=gte.{start_date}T00:00:00&created_at=lte.{end_date}T23:59:59",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
      },
      "response": {
        "200": [
          {
            "total": 50000,
            "created_at": "2024-01-01T10:00:00Z",
            "detail_pesanan": [
              {
                "subtotal": 50000,
                "jumlah": 2,
                "menu": {
                  "id": 1,
                  "nama": "Kopi Susu",
                  "kategori_id": 1,
                  "harga": 25000,
                  "kategori_menu": {
                    "id": 1,
                    "nama": "Coffee"
                  }
                }
              }
            ]
          }
        ],
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 2,
      "name": "Fetch Expenses for Financial Summary",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pengeluaran",
      "method": "GET",
      "params": "select=jumlah&tanggal=gte.{start_date}&tanggal=lte.{end_date}",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
      },
      "response": {
        "200": [
          {
            "jumlah": 150000
          }
        ],
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 3,
      "name": "Fetch Previous Period Revenue (for Growth Calculation)",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan",
      "method": "GET",
      "params": "select=total&status=eq.selesai&created_at=gte.{prev_start_date}&created_at=lte.{prev_end_date}T23:59:59",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
      },
      "response": {
        "200": [
          {
            "total": 45000
          }
        ],
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 4,
      "name": "Fetch Previous Period Expenses (for Reduction Calculation)",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pengeluaran",
      "method": "GET",
      "params": "select=jumlah&tanggal=gte.{prev_start_date}&tanggal=lte.{prev_end_date}",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
      },
      "response": {
        "200": [
          {
            "jumlah": 120000
          }
        ],
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 5,
      "name": "Fetch Transactions with Pagination",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pesanan",
      "method": "GET",
      "params": "select=id,no_meja,total,status,created_at,updated_at,detail_pesanan(id,menu_id,jumlah,subtotal,menu(nama,harga))&status=eq.selesai&order=created_at.desc&created_at=gte.{start_date}T00:00:00&created_at=lte.{end_date}T23:59:59",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Range": "{start}-{end}",
        "Prefer": "count=exact"
      },
      "response": {
        "200": [
          {
            "id": 1,
            "no_meja": "5",
            "total": 50000,
            "status": "selesai",
            "created_at": "2024-01-01T10:00:00Z",
            "updated_at": "2024-01-01T10:30:00Z",
            "detail_pesanan": [
              {
                "id": 1,
                "menu_id": 1,
                "jumlah": 2,
                "subtotal": 50000,
                "menu": {
                  "nama": "Kopi Susu",
                  "harga": 25000
                }
              }
            ]
          }
        ],
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 6,
      "name": "Fetch All Expenses",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pengeluaran",
      "method": "GET",
      "params": "select=*&order=created_at.desc&tanggal=gte.{start_date}&tanggal=lte.{end_date}",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
      },
      "response": {
        "200": [
          {
            "id": 1,
            "kategori": "operasional",
            "deskripsi": "Beli bahan kopi",
            "jumlah": 150000,
            "tanggal": "2024-01-01",
            "created_at": "2024-01-01T10:00:00Z",
            "foto_url": "https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/..."
          }
        ],
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 7,
      "name": "Insert New Expense",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pengeluaran",
      "method": "POST",
      "payload": {
        "deskripsi": "Beli bahan kopi",
        "jumlah": 150000,
        "kategori": "bahan_baku",
        "tanggal": "2024-01-01",
        "foto_url": "https://..."
      },
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Content-Type": "application/json",
        "Prefer": "return=representation"
      },
      "response": {
        "201": [
          {
            "id": 1,
            "kategori": "bahan_baku",
            "deskripsi": "Beli bahan kopi",
            "jumlah": 150000,
            "tanggal": "2024-01-01",
            "created_at": "2024-01-01T10:00:00Z",
            "foto_url": "https://..."
          }
        ],
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 8,
      "name": "Delete Expense",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/pengeluaran",
      "method": "DELETE",
      "params": "id=eq.{expense_id}",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
      },
      "response": {
        "204": "No Content (Success)",
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 9,
      "name": "Upload Photo to Storage",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/{bucket_name}/expense-photos/{filename}",
      "method": "POST",
      "payload": "Binary file data",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Content-Type": "image/jpeg|image/png|image/gif",
        "Cache-Control": "3600"
      },
      "response": {
        "200": {
          "Key": "expense-photos/expense_1234567890_abc123.jpg",
          "Id": "..."
        },
        "400": {
          "error": "Bad Request"
        },
        "413": {
          "error": "File too large"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 10,
      "name": "Get Public URL for Uploaded Photo",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/{bucket_name}/{file_path}",
      "method": "GET",
      "params": "None (Public URL generation)",
      "headers": {
        "None": "Public URL, no auth needed"
      },
      "response": {
        "200": {
          "publicUrl": "https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/..."
        }
      }
    },
    {
      "no": 11,
      "name": "Check Cafe Status",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings",
      "method": "GET",
      "params": "select=is_open&limit=1",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
      },
      "response": {
        "200": {
          "is_open": true
        },
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 12,
      "name": "Create Initial Cafe Settings",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings",
      "method": "POST",
      "payload": {
        "is_open": true
      },
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Content-Type": "application/json"
      },
      "response": {
        "201": {
          "id": 1,
          "is_open": true,
          "created_at": "2024-01-01T10:00:00Z"
        },
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 13,
      "name": "Check Existing Cafe Settings",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings",
      "method": "GET",
      "params": "select=id&limit=1",
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
      },
      "response": {
        "200": {
          "id": 1
        },
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 14,
      "name": "Update Cafe Status",
      "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings",
      "method": "PATCH",
      "params": "id=eq.{settings_id}",
      "payload": {
        "is_open": false,
        "updated_at": "2024-01-01T10:00:00Z"
      },
      "headers": {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "Content-Type": "application/json"
      },
      "response": {
        "200": {
          "id": 1,
          "is_open": false,
          "updated_at": "2024-01-01T10:00:00Z"
        },
        "400": {
          "error": "Bad Request"
        },
        "500": {
          "error": "Internal Server Error"
        }
      }
    },
    {
      "no": 15,
      "name": "Realtime Subscribe - Cafe Status Updates",
      "endpoint": "wss://wqsizttvrwwddquftpnq.supabase.co/realtime/v1",
      "method": "WEBSOCKET",
      "channel": "cafe_settings_channel_pembukuan",
      "event": "*",
      "table": "cafe_settings",
      "schema": "public",
      "response": {
        "new": {
          "id": 1,
          "is_open": false,
          "updated_at": "2024-01-01T10:00:00Z"
        }
      }
    }
  ],
  "storage_operations": [
    {
      "operation": "List Bucket Files",
      "description": "List files in storage bucket for testing",
      "bucket_names": [
        "bukti-pengeluaran",
        "expense-photos",
        "assets",
        "public"
      ]
    },
    {
      "operation": "Create Storage Bucket",
      "description": "Create new storage bucket if not exists",
      "bucket_config": {
        "name": "bukti-pengeluaran",
        "public": true,
        "allowedMimeTypes": [
          "image/jpeg",
          "image/jpg",
          "image/png",
          "image/gif"
        ],
        "fileSizeLimit": 3145728
      }
    }
  ],
  "additional_features": {
    "chart_data_processing": {
      "revenue_chart": "Processes daily/hourly revenue data for Line chart",
      "category_chart": "Processes category sales data for Doughnut chart"
    },
    "export_functionality": {
      "format": "XLSX (Excel)",
      "sheets": [
        "Ringkasan (Financial Summary)",
        "Pemasukan (Income/Transactions)",
        "Pengeluaran (Expenses)"
      ],
      "data_source": "Fetches ALL transactions and expenses (no pagination)"
    },
    "image_compression": {
      "max_dimension": 1920,
      "quality": 0.8,
      "max_size": "3MB",
      "supported_formats": [
        "JPG",
        "PNG",
        "GIF"
      ]
    }
  },
  "notes": {
    "date_filtering": "All queries support date range filtering with start_date and end_date",
    "timezone": "Uses WIB (UTC+7) timezone via getLocalDateString() utility",
    "pagination": {
      "transactions": "10 items per page",
      "expenses": "5 items per page"
    },
    "storage_bucket_detection": "Auto-detects working storage bucket from predefined list",
    "reset_functionality": "UI-only reset (does not delete database data)",
    "realtime_updates": "Subscribes to cafe_settings changes for live status updates"
  }
}


Adminmenu.vue

{
  "file": "AdminMenu.vue",
  "total_api_calls": 47,
  "categories": {
    "menu_management": 6,
    "stock_management": 3,
    "category_management": 6,
    "discount_management": 3,
    "additional_management": 4,
    "best_seller_management": 5,
    "statistics": 2,
    "store_status": 3,
    "image_upload": 1,
    "realtime_subscription": 1
  },
  
  "apis": [
    {
      "category": "📊 STATISTICS & DASHBOARD",
      "endpoints": [
        {
          "no": 1,
          "name": "Get Total Menu Count",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu",
          "table": "menu",
          "operation": "select",
          "params": {
            "count": "exact",
            "head": true
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "count": 25
          },
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "fetchStats()"
        },
        {
          "no": 2,
          "name": "Get All Menu with Category & Stock",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu",
          "table": "menu",
          "operation": "select",
          "query": "id, stok, kategori_id, kategori_menu!inner(id, nama)",
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "id": 1,
              "stok": 50,
              "kategori_id": 1,
              "kategori_menu": {
                "id": 1,
                "nama": "Coffee"
              }
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "fetchStats()"
        }
      ]
    },
    
    {
      "category": "☕ MENU MANAGEMENT",
      "endpoints": [
        {
          "no": 3,
          "name": "Get Menu List (Without Stock)",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu",
          "table": "menu",
          "operation": "select",
          "query": "id, nama, harga, foto, kategori_id, kategori_struk, kategori_menu(id, nama)",
          "order": {
            "column": "id",
            "ascending": false
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "id": 1,
              "nama": "Cappuccino",
              "harga": 25000,
              "foto": "Menu/coffee.jpg",
              "kategori_id": 1,
              "kategori_struk": "minuman",
              "kategori_menu": {
                "id": 1,
                "nama": "Coffee"
              }
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "fetchMenuList()",
          "notes": "Digunakan untuk tab Menu - tanpa field stok"
        },
        {
          "no": 4,
          "name": "Get Menu List (With Stock)",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu",
          "table": "menu",
          "operation": "select",
          "query": "id, nama, harga, foto, stok, kategori_id, kategori_struk, kategori_menu(id, nama)",
          "order": {
            "column": "id",
            "ascending": false
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "id": 1,
              "nama": "Cappuccino",
              "harga": 25000,
              "foto": "Menu/coffee.jpg",
              "stok": 50,
              "kategori_id": 1,
              "kategori_struk": "minuman",
              "kategori_menu": {
                "id": 1,
                "nama": "Coffee"
              }
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "fetchMenuWithStock()",
          "notes": "Digunakan untuk tab Stock - dengan field stok"
        },
        {
          "no": 5,
          "name": "Get Category List",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/kategori_menu",
          "table": "kategori_menu",
          "operation": "select",
          "query": "id, nama",
          "order": {
            "column": "nama",
            "ascending": true
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "id": 1,
              "nama": "Coffee"
            },
            {
              "id": 2,
              "nama": "Non Coffee"
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "fetchCategoryList()"
        },
        {
          "no": 6,
          "name": "Insert New Menu",
          "method": "POST",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu",
          "table": "menu",
          "operation": "insert",
          "payload": {
            "nama": "Cappuccino",
            "kategori_id": 1,
            "kategori_struk": "minuman",
            "harga": 25000,
            "foto": "Menu/coffee_123456.jpg"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json",
            "Prefer": "return=representation"
          },
          "response_success": [
            {
              "id": 26,
              "nama": "Cappuccino",
              "kategori_id": 1,
              "kategori_struk": "minuman",
              "harga": 25000,
              "foto": "Menu/coffee_123456.jpg"
            }
          ],
          "response_error": {
            "error": "Permission denied / row-level security"
          },
          "used_in_method": "handleAddMenu()"
        },
        {
          "no": 7,
          "name": "Update Menu",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?id=eq.{menu_id}",
          "table": "menu",
          "operation": "update",
          "payload": {
            "nama": "Cappuccino Updated",
            "kategori_id": 1,
            "kategori_struk": "minuman",
            "harga": 28000,
            "foto": "Menu/coffee_updated.jpg"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json",
            "Prefer": "return=representation"
          },
          "response_success": [
            {
              "id": 1,
              "nama": "Cappuccino Updated",
              "harga": 28000
            }
          ],
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "handleAddMenu()"
        },
        {
          "no": 8,
          "name": "Delete Menu",
          "method": "DELETE",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?id=eq.{menu_id}",
          "table": "menu",
          "operation": "delete",
          "payload": null,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "status": 204,
            "message": "No Content"
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "deleteMenu(menuId)"
        }
      ]
    },
    
    {
      "category": "📦 STOCK MANAGEMENT",
      "endpoints": [
        {
          "no": 9,
          "name": "Get Current Stock by Menu ID",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?id=eq.{menu_id}&select=stok",
          "table": "menu",
          "operation": "select",
          "query": "stok",
          "filter": {
            "id": "eq.{menu_id}"
          },
          "single": true,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "stok": 50
          },
          "response_error": {
            "error": "Not found"
          },
          "used_in_method": "handleAddStock()"
        },
        {
          "no": 10,
          "name": "Update Stock (Add Stock)",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?id=eq.{menu_id}",
          "table": "menu",
          "operation": "update",
          "payload": {
            "stok": 75
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "handleAddStock()",
          "notes": "Menambah stok dari current stock + quantity"
        },
        {
          "no": 11,
          "name": "Update Stock (Direct Set)",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?id=eq.{menu_id}",
          "table": "menu",
          "operation": "update",
          "payload": {
            "stok": 100
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "saveStockFromModal(), saveStock()"
        }
      ]
    },
    
    {
      "category": "🎟️ DISCOUNT MANAGEMENT",
      "endpoints": [
        {
          "no": 12,
          "name": "Get Discount List",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/discount_codes",
          "table": "discount_codes",
          "operation": "select",
          "query": "id, code, type, value",
          "order": {
            "column": "id",
            "ascending": false
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "id": 1,
              "code": "PROMO50",
              "type": "percent",
              "value": 50
            },
            {
              "id": 2,
              "code": "DISKON10K",
              "type": "fixed",
              "value": 10000
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "fetchDiscountList()"
        },
        {
          "no": 13,
          "name": "Insert Discount",
          "method": "POST",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/discount_codes",
          "table": "discount_codes",
          "operation": "insert",
          "payload": {
            "code": "NEWPROMO",
            "type": "percent",
            "value": 20
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 201
          },
          "response_error": {
            "error": "Duplicate / Permission denied"
          },
          "used_in_method": "saveDiscount()"
        },
        {
          "no": 14,
          "name": "Update Discount",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/discount_codes?id=eq.{discount_id}",
          "table": "discount_codes",
          "operation": "update",
          "payload": {
            "code": "UPDATEPROMO",
            "type": "fixed",
            "value": 15000
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "saveDiscount()"
        },
        {
          "no": 15,
          "name": "Delete Discount",
          "method": "DELETE",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/discount_codes?id=eq.{discount_id}",
          "table": "discount_codes",
          "operation": "delete",
          "payload": null,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "deleteDiscount(id)"
        }
      ]
    },
    
    {
      "category": "📂 CATEGORY MANAGEMENT",
      "endpoints": [
        {
          "no": 16,
          "name": "Get Categories with Menu Count",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/kategori_menu",
          "table": "kategori_menu",
          "operation": "select",
          "query": "*, menu:menu(count)",
          "order": {
            "column": "urutan",
            "ascending": true
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "id": 1,
              "nama": "Coffee",
              "urutan": 1,
              "menu": [
                {
                  "count": 15
                }
              ]
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "fetchCategories()"
        },
        {
          "no": 17,
          "name": "Insert Category",
          "method": "POST",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/kategori_menu",
          "table": "kategori_menu",
          "operation": "insert",
          "payload": {
            "nama": "New Category"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 201
          },
          "response_error": {
            "error": "Duplicate / Permission denied"
          },
          "used_in_method": "saveCategory(), addCategory()"
        },
        {
          "no": 18,
          "name": "Update Category",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/kategori_menu?id=eq.{category_id}",
          "table": "kategori_menu",
          "operation": "update",
          "payload": {
            "nama": "Updated Category"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "saveCategory()"
        },
        {
          "no": 19,
          "name": "Update Category Order (Drag & Drop)",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/kategori_menu?id=eq.{category_id}",
          "table": "kategori_menu",
          "operation": "update",
          "payload": {
            "urutan": 3
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "updateCategoryOrder(newOrder)",
          "notes": "Digunakan untuk Sortable.js drag & drop"
        },
        {
          "no": 20,
          "name": "Delete Category",
          "method": "DELETE",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/kategori_menu?id=eq.{category_id}",
          "table": "kategori_menu",
          "operation": "delete",
          "payload": null,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "deleteCategory(id)"
        },
        {
          "no": 21,
          "name": "Get Menus by Category ID",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?kategori_id=eq.{category_id}",
          "table": "menu",
          "operation": "select",
          "query": "id, nama, harga, foto, stok, kategori_struk, kategori_id, kategori_menu(id, nama)",
          "filter": {
            "kategori_id": "eq.{category_id}"
          },
          "order": {
            "column": "nama",
            "ascending": true
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "id": 1,
              "nama": "Cappuccino",
              "harga": 25000,
              "foto": "Menu/coffee.jpg",
              "stok": 50,
              "kategori_struk": "minuman",
              "kategori_id": 1,
              "kategori_menu": {
                "id": 1,
                "nama": "Coffee"
              }
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "showCategoryMenus(category)"
        }
      ]
    },
    
    {
      "category": "🍪 ADDITIONAL ITEMS MANAGEMENT",
      "endpoints": [
        {
          "no": 22,
          "name": "Get Additional List",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/additionals",
          "table": "additionals",
          "operation": "select",
          "query": "*",
          "order": {
            "column": "nama",
            "ascending": true
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "id": 1,
              "nama": "Extra Shot",
              "harga": 5000
            },
            {
              "id": 2,
              "nama": "Whipped Cream",
              "harga": 3000
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "fetchAdditionals()"
        },
        {
          "no": 23,
          "name": "Insert Additional",
          "method": "POST",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/additionals",
          "table": "additionals",
          "operation": "insert",
          "payload": {
            "nama": "Extra Milk",
            "harga": 4000
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 201
          },
          "response_error": {
            "error": "Duplicate / Permission denied"
          },
          "used_in_method": "saveAdditional(), addAdditional()"
        },
        {
          "no": 24,
          "name": "Update Additional",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/additionals?id=eq.{additional_id}",
          "table": "additionals",
          "operation": "update",
          "payload": {
            "nama": "Updated Extra",
            "harga": 6000
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "saveAdditional()"
        },
        {
          "no": 25,
          "name": "Delete Additional",
          "method": "DELETE",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/additionals?id=eq.{additional_id}",
          "table": "additionals",
          "operation": "delete",
          "payload": null,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "deleteAdditional(id)"
        },
        {
          "no": 26,
          "name": "Get Menu Additionals (Junction Table)",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu_additionals?menu_id=eq.{menu_id}",
          "table": "menu_additionals",
          "operation": "select",
          "query": "additional_id, additional_menu(id, name, price)",
"filter": {
            "menu_id": "eq.{menu_id}"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "additional_id": 1,
              "additional_menu": {
                "id": 1,
                "name": "Extra Shot",
                "price": 5000
              }
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "viewMenuAdditionals(menu)"
        },
        {
          "no": 27,
          "name": "Delete Menu Additional (Remove from Junction)",
          "method": "DELETE",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu_additionals?menu_id=eq.{menu_id}&additional_id=eq.{additional_id}",
          "table": "menu_additionals",
          "operation": "delete",
          "payload": null,
          "match": {
            "menu_id": "{menu_id}",
            "additional_id": "{additional_id}"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "removeMenuAdditional(menuId, additionalId)"
        }
      ]
    },
    
    {
      "category": "⭐ BEST SELLER MANAGEMENT",
      "endpoints": [
        {
          "no": 28,
          "name": "Get Best Seller Auto Mode Status",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings?select=best_seller_auto_mode&limit=1",
          "table": "cafe_settings",
          "operation": "select",
          "query": "best_seller_auto_mode",
          "limit": 1,
          "single": true,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "best_seller_auto_mode": true
          },
          "response_error": {
            "error": "Not found",
            "code": "PGRST116"
          },
          "used_in_method": "fetchBestSellerData()"
        },
        {
          "no": 29,
          "name": "Get Sales Data for Best Seller",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/detail_pesanan",
          "table": "detail_pesanan",
          "operation": "select",
          "query": "menu_id, jumlah, subtotal, pesanan!inner(status, is_hidden)",
          "filter": {
            "pesanan.status": "eq.selesai",
            "pesanan.is_hidden": "eq.false"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": [
            {
              "menu_id": 1,
              "jumlah": 5,
              "subtotal": 125000,
              "pesanan": {
                "status": "selesai",
                "is_hidden": false
              }
            }
          ],
          "response_error": {
            "error": "Error message"
          },
          "used_in_method": "fetchBestSellerData()",
          "notes": "Data diagregasi untuk hitung total_sold & total_revenue per menu"
        },
        {
          "no": 30,
          "name": "Update Best Seller Auto Mode",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings?id=eq.{settings_id}",
          "table": "cafe_settings",
          "operation": "update",
          "payload": {
            "best_seller_auto_mode": true
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "toggleAutoMode()"
        },
        {
          "no": 31,
          "name": "Insert Best Seller Auto Mode (If Not Exist)",
          "method": "POST",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings",
          "table": "cafe_settings",
          "operation": "insert",
          "payload": {
            "best_seller_auto_mode": true,
            "is_open": true
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 201
          },
          "response_error": {
            "error": "Duplicate / Permission denied"
          },
          "used_in_method": "toggleAutoMode()"
        },
        {
          "no": 32,
          "name": "Toggle Best Seller Status (Manual Mode)",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?id=eq.{menu_id}",
          "table": "menu",
          "operation": "update",
          "payload": {
            "is_best_seller": true
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Column 'is_best_seller' doesn't exist / Permission denied"
          },
          "used_in_method": "toggleBestSeller(menu)",
          "notes": "Hanya untuk manual mode, auto mode tidak bisa toggle"
        },
        {
          "no": 33,
          "name": "Clear All Best Sellers",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?id=neq.0",
          "table": "menu",
          "operation": "update",
          "payload": {
            "is_best_seller": false
          },
          "filter": {
            "id": "neq.0"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Permission denied"
          },
          "used_in_method": "toggleAutoMode(), updateAutoModeBestSellers()",
          "notes": "Reset semua menu, id neq 0 artinya update all rows"
        },
        {
          "no": 34,
          "name": "Set Top 10 as Best Sellers (Auto Mode)",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?id=in.({top10_ids})",
          "table": "menu",
          "operation": "update",
          "payload": {
            "is_best_seller": true
          },
          "filter": {
            "id": "in.({top10_ids})"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Permission denied"
          },
          "used_in_method": "updateAutoModeBestSellers()",
          "notes": "Set top 10 menu berdasarkan penjualan tertinggi"
        }
      ]
    },
    
    {
      "category": "🏪 STORE STATUS MANAGEMENT",
      "endpoints": [
        {
          "no": 35,
          "name": "Get Store Status (is_open)",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings?select=is_open&limit=1",
          "table": "cafe_settings",
          "operation": "select",
          "query": "is_open",
          "limit": 1,
          "single": true,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "is_open": true
          },
          "response_error": {
            "error": "Not found",
            "code": "PGRST116"
          },
          "used_in_method": "fetchStoreStatus()"
        },
        {
          "no": 36,
          "name": "Insert Store Status (If Not Exist)",
          "method": "POST",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings",
          "table": "cafe_settings",
          "operation": "insert",
          "payload": {
            "is_open": true
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 201
          },
          "response_error": {
            "error": "Duplicate / Permission denied"
          },
          "used_in_method": "fetchStoreStatus()"
        },
        {
          "no": 37,
          "name": "Update Store Status (Open/Close)",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings?id=eq.{settings_id}",
          "table": "cafe_settings",
          "operation": "update",
          "payload": {
            "is_open": false,
            "updated_at": "2025-01-20T10:30:00.000Z"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Not found / Permission denied"
          },
          "used_in_method": "confirmStoreStatus()"
        }
      ]
    },
    
    {
      "category": "🖼️ IMAGE UPLOAD (Supabase Storage)",
      "endpoints": [
        {
          "no": 38,
          "name": "Upload Menu Image",
          "method": "POST",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/assets/Menu/{filename}",
          "bucket": "assets",
          "folder": "Menu",
          "operation": "upload",
          "payload": "File (FormData)",
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "image/jpeg"
          },
          "params": {
            "cacheControl": "3600",
            "upsert": false
          },
          "response_success": {
            "Key": "Menu/1234567890_abc123.jpg",
            "Id": "uuid-here"
          },
          "response_error": {
            "error": "Upload failed / Permission denied"
          },
          "used_in_method": "uploadImage()",
          "notes": "Return path: Menu/filename.jpg (bukan full URL)"
        },
        {
          "no": 39,
          "name": "Get Public URL for Image",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/assets/Menu/{filename}",
          "bucket": "assets",
          "operation": "getPublicUrl",
          "payload": null,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "publicUrl": "https://wqsizttvrwwddquftpnq.supabase.co/storage/v1/object/public/assets/Menu/coffee.jpg"
          },
          "response_error": {
            "error": "Not found"
          },
          "used_in_method": "getImageUrl(fotoPath)",
          "notes": "Generate full public URL dari path storage"
        }
      ]
    },
    
    {
      "category": "🔴 REALTIME SUBSCRIPTIONS",
      "endpoints": [
        {
          "no": 40,
          "name": "Subscribe Store Status Changes",
          "method": "WEBSOCKET",
          "endpoint": "wss://wqsizttvrwwddquftpnq.supabase.co/realtime/v1/websocket",
          "channel": "cafe_settings_channel_menu",
          "table": "cafe_settings",
          "schema": "public",
          "event": "*",
          "operation": "subscribe",
          "payload": null,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_realtime": {
            "event": "UPDATE",
            "payload": {
              "new": {
                "is_open": false,
                "updated_at": "2025-01-20T10:30:00.000Z"
              },
              "old": {
                "is_open": true
              }
            }
          },
          "used_in_method": "subscribeToStoreStatus()",
          "notes": "Listen perubahan status toko (buka/tutup) secara realtime"
        }
      ]
    },
    
    {
      "category": "🔧 UTILITY & HELPER APIs",
      "endpoints": [
        {
          "no": 41,
          "name": "Get Settings ID for Update",
          "method": "GET",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/cafe_settings?select=id&limit=1",
          "table": "cafe_settings",
          "operation": "select",
          "query": "id",
          "limit": 1,
          "single": true,
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
          },
          "response_success": {
            "id": 1
          },
          "response_error": {
            "error": "Not found"
          },
          "used_in_method": "confirmStoreStatus(), toggleAutoMode()"
        },
        {
          "no": 42,
          "name": "Sync Kategori Struk for All Menus",
          "method": "PATCH",
          "endpoint": "https://wqsizttvrwwddquftpnq.supabase.co/rest/v1/menu?id=eq.{menu_id}",
          "table": "menu",
          "operation": "update",
          "payload": {
            "kategori_struk": "minuman"
          },
          "headers": {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
            "Content-Type": "application/json"
          },
          "response_success": {
            "status": 204
          },
          "response_error": {
            "error": "Permission denied"
          },
          "used_in_method": "syncKategoriStrukForAllMenus()",
          "notes": "Batch update kategori_struk berdasarkan kategori_menu.nama"
        }
      ]
    }
  ],
  
  "summary": {
    "total_endpoints": 42,
    "breakdown": {
      "GET": 15,
      "POST": 7,
      "PATCH": 18,
      "DELETE": 5,
      "WEBSOCKET": 1,
      "STORAGE_UPLOAD": 1,
      "STORAGE_GET_URL": 1
    },
    "tables_involved": [
      "menu",
      "kategori_menu",
      "discount_codes",
      "additionals",
      "menu_additionals",
      "cafe_settings",
      "detail_pesanan",
      "pesanan"
    ],
    "storage_buckets": [
      "assets (folder: Menu)"
    ],
    "realtime_channels": [
      "cafe_settings_channel_menu"
    ]
  },
  
  "important_notes": {
    "authentication": "Semua API memerlukan apikey & Authorization Bearer token dari Supabase",
    "base_url": "https://wqsizttvrwwddquftpnq.supabase.co",
    "rest_api_prefix": "/rest/v1/",
    "storage_prefix": "/storage/v1/",
    "realtime_prefix": "wss://wqsizttvrwwddquftpnq.supabase.co/realtime/v1/websocket",
    "image_upload_rules": {
      "max_size": "2MB",
      "allowed_formats": ["JPG", "PNG", "WebP"],
      "folder": "Menu/",
      "naming": "{timestamp}_{random}.{ext}"
    },
    "best_seller_feature": {
      "requires_migration": true,
      "sql_column": "is_best_seller BOOLEAN DEFAULT false",
      "auto_mode": "Top 10 berdasarkan total_revenue",
      "manual_mode": "User pilih sendiri via checkbox"
    },
    "stock_management": {
      "add_stock": "current_stock + quantity",
      "direct_set": "Replace dengan nilai baru",
      "stock_levels": {
        "0": "Kosong",
        "1-3": "Bahaya Sangat Menipis",
        "4-10": "Peringatan Rendah",
        "11-15": "Perlu Ditambah",
        "16-30": "Stok Sedang",
        "31+": "Stok Aman"
      }
    },
    "category_drag_drop": {
      "library": "Sortable.js",
      "column": "urutan",
      "operation": "Batch update urutan setiap kategori"
    },
    "caching_strategy": {
      "menu": "Cache di cachedData.menu",
      "stock": "Cache di cachedData.stock",
      "diskon": "Cache di cachedData.diskon",
      "bestseller": "Cache di cachedData.bestseller"
    }
  },
  
  "error_handling": {
    "common_errors": [
      {
        "code": "PGRST116",
        "meaning": "Row not found (untuk .single())",
        "solution": "Insert data baru jika belum ada"
      },
      {
        "code": "row-level security",
        "meaning": "Permission denied",
        "solution": "Cek RLS policy di Supabase"
      },
      {
        "message": "duplicate",
        "meaning": "Data sudah ada (unique constraint)",
        "solution": "Cek data existing sebelum insert"
      },
      {
        "message": "is_best_seller",
        "meaning": "Column doesn't exist",
        "solution": "Run migration SQL untuk add column"
      }
    ]
  },
  
  "performance_optimization": {
    "lazy_loading": [
      "fetchStats() - background",
      "fetchDiscountList() - on tab switch",
      "fetchAdditionals() - background",
      "fetchBestSellerData() - on tab switch"
    ],
    "immediate_loading": [
      "fetchMenuList() - critical",
      "fetchCategoryList() - critical",
      "fetchStoreStatus() - critical"
    ],
    "realtime_subscription": "Only cafe_settings changes",
    "caching": "Prevent redundant API calls on tab switch"
  }
}

