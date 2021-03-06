 
کمک به آژانس مسافربری

نکات:

1.در این کد نباید (و لازم نیست) از دیتابیس استفاده کنید.

2.پس از پایان نوشتن برنامه مورد نظر، با ثبت آن در قسمت زیر، باید برای کسب نمره ۱۰۰ از تست‌‌ها تلاش کنید.

3.در این سوال ساختارمندی و کد تمیز 
(clean code) 

نیز در کنار کارکرد صحیح برنامه، از اهمیت برخوردار است.

4.برای زمان و حافظه انتظار بهترین مرتبه وجود ندارد ولی نباید اردر راه‌حل به گونه‌ای باشد که این محدودیت‌ها باعث کسر نمره شود.

می‌خواهیم برنامه‌ای بنویسیم تا به مدیریت یک آژانس مسافربری برای مدیریت شهرهای مبدا مقصد و مسیرها، سفرها و مسافران کمک کند.

برنامه این‌گونه کار می‌کند که پس از شروع وارد منوی اولیه شامل گزینه‌هایی که کاربر می‌تواند انتخاب کند را به او نشان داده. هر آیتم در این لیست یک شماره دارد که از ۱ شروع می‌شود و به ترتیب ادامه پیدا می‌کند. کاربر شماره دستور را وارد می‌کند. با توجه به انتخاب کاربر نمایش منوهای بعدی صورت می‌گیرد تا اینکه یک عملیات کامل صورت گیرد و سپس به منوی اولیه برمی‌گردیم..
 
 

منوی اولیه به صورت زیر است
```sh
Main Menu - Select an action:
1. Help
2. Add
3. Delete
4. Path
5. Exit
```

این دستورات در ادامه توضیح داده خواهد شد. قبل از آن نیز لازم است به توضیح مدل‌های داده‌ای برنامه بپردازیم تا در توضیح دستورات به آن‌ها ارجاع دهیم. هر مدل به همراه ویژگی‌های آن در ادامه توضیح داده شده است.

در پایان مثالی آمده است که سعی شده در آن همه دستورات در بیشتر حالات پوشش داده شود تا از ابهام نوع ورودی گرفتن کاسته شود.

مدل  City
field name |	field value
| :---: | :---: |
id 	|int - عدد صحیح مثبت
name |	string - یک رشته متشکل از حروف و اعداد

مدل Road
field name |	field value
| :---: | :---: |
id |	int - عدد صحیح مثبت
name| 	string - یک رشته متشکل از حروف و اعداد
from |	int - شماره شهر شروع جاده
to |	int - شماره شهر پایان جاده
through |	list of int - یک لیست از شماره شهرهایی که در بین مسیر وجود دارد به ترتیب دیده شدن
speed_limit |	int - محدودیت سرعت
length |	int - طول مسیر
bi_directional| 	0 or 1 - نشان دهنده دوطرفه بودن یا نبودن مسیر

توضیح دستورات


دستور نامعتبر

ورودی:

هرچیزی غیر از عددهای موجود در منو. ممکن است عدد اعشاری، رشته یا ورودی خالی و ... باشد. این اتفاق تنها ممکن است در منوی اصلی اتفاق بیفتد. پس از این خروجی باید دوباره منوی اصلی چاپ شود.

خروجی:

```sh
Invalid input. Please enter 1 for more info.
```

## ۱. توضیحات برنامه

1. Help


منوی بعدی‌ای وجود ندارد.

خروجی:

```sh 
Select a number from shown menu and enter. For example 1 is for help.
```

## ۲. اضافه کردن اطلاعات

```sh
2. Add
```

منوی بعدی:

```sh
Select model:
1. City
2. Road
```


کاربر در این مرحله انتخاب می‌کند که چه نوع دیتایی می‌خواهد اضافه کند. یک شهر یا یک جاده.

سپس به ازای هر فیلد موجود در مدل، به ترتیب سطرهای جدول مربوط به مدل در بالا، در یک خط جدا چاپ می‌شود:

```sh
<field_name>=?
```


و کاربر 

field_value یا همان مقدار فیلد را وارد می‌کند.

دقت کنید که برای هر مدل

id باید یکتا و غیرتکراری باشد و در صورت تکرار یک

id باید دیتای فیلدهای دیگر مربوط به آن داده بازنویسی شود.

پس از ثبت دیتا با موفقیت منوی بعدی به این صورت است. دقت کنید که 

Model همان مدلی است که برای اضافه شدن انتخاب شده است و 

id همان id

است که مدل با آن اضافه شده است.

```sh
 <Model> with id=<id> added!
Select your next action
1. Add another <Model>
2. Main Menu
 ```


گزینه ۱ ما را به مرحله ورودی گرفتن برای اضافه کردن می‌برد و گزینه ۲ به منوی اصلی می‌رود.
## ۳. حذف کردن اطلاعات

```sh 
3. Delete
```


منوی بعدی:

```sh
Select model:
1. City
2. Road
```


کاربر در این مرحله انتخاب می‌کند که چه نوع دیتایی می‌خواهد حذف کند. یک شهر یا یک جاده.

در مرحله بعد کاربر باید id 

مربوط را وارد کنید.

در صورت پیدا شدن و حذف باید پیغام زیر چاپ شود.

Model و id 

طبق ورودی‌های کاربر مقداردهی می‌شود.

```sh
<Model>:<id> deleted!
```

وگرنه:

```sh
 <Model> with id <id> not found!
```


پس از چاپ پیغام وارد منوی اصلی می‌شویم.
## ۴. نمایش دادن مسیر

```sh 
4. Path
```


در صورت انتخاب این گزینه، در مرحله بعد باید یک ورودی به شکل

```sh
<SourceCityId>:<DestinationCityId>
```


بدهد که اولی

id شهر شروع مسیر و دومی 

id شهر پایان مسیر است.

باید به عنوان خروجی هر مسیری که از شهر شروع و پایان بگذرد بیاید. دقت کنید این شهرها الزاما شروع و پایان جاده‌ها نیستند و ممکن است در مسیر دو شهر دیگر باشند. دقت کنید مسیرهایی مطلوب هستند که در یک جاده قرار دارند و بدون عوض کردن جاده از مبدا به مقصد می‌رسید. سپس به ترتیب زمان مسیر به ازای هر مسیر یک سطر به صورت زیر چاپ کند:

```sh
<SourceCityName>:<DestinationCityName> via Road <RoadName>: Takes <DD:HH:MM>
```


که متغیرهای این دستور بدین شکل است:

SourceCityName: نام شهر شروع مسیر

DestinationCityName: نام شهر پایان مسیر

RoadName: نام جاده

DD:HH:MM:

با توجه به حداکثر سرعت جاده و با فرض طی مسیر با ان سرعت، زمانی است که طول می‌کشد تا مسیر را بپیماییم. منظور از

DD تعداد روز و 

HH تعداد ساعت و 

MM تعداد دقیقه‌ای است که طول می‌کشد.

## ۵. خروج از برنامه

```sh
5. Exit
```

برنامه بسته می‌شود.
مثال
ورودی نمونه
```sh
1
2
1
21
Tehran
1
251
Qom
1
361
Kashan
2
2
2
1
T-K
21
361
[21,251]
80
600
1
2
4
361:251
3
1
21
5
```
 
خروجی نمونه

```sh
Main Menu - Select an action:
1. Help
2. Add
3. Delete
4. Path
5. Exit
Select a number from shown menu and enter. For example 1 is for help.
Main Menu - Select an action:
1. Help
2. Add
3. Delete
4. Path
5. Exit
Select model:
1. City
2. Road
id=?
name=?
City with id=21 added!
Select your next action
1. Add another City
2. Main Menu
id=?
name=?
City with id=251 added!
Select your next action
1. Add another City
2. Main Menu
id=?
name=?
City with id=361 added!
Select your next action
1. Add another City
2. Main Menu
Main Menu - Select an action:
1. Help
2. Add
3. Delete
4. Path
5. Exit
Select model:
1. City
2. Road
id=?
name=?
from=?
to=?
through=?
speed_limit=?
length=?
bi_directional=?
Road with id=1 added!
Select your next action
1. Add another Road
2. Main Menu
Main Menu - Select an action:
1. Help
2. Add
3. Delete
4. Path
5. Exit
Kashan:Qom via Road T-K: Takes 00:07:30
Main Menu - Select an action:
1. Help
2. Add
3. Delete
4. Path
5. Exit
Select model:
1. City
2. Road
City:21 deleted!
Main Menu - Select an action:
1. Help
2. Add
3. Delete
4. Path
5. Exit
```
