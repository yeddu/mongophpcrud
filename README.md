# mongophp

#In MongoDB,
#Tables are called as “Collection”
#Rows are called as “Documents”
#Columns are called as “Fields”



#show dbs


> use test
switched to db test

db.users.createIndex({"email":1}, {unique:true})

> db.users.insert({name:"Mukesh Chapagain", age:88, email:"mukesh@example.com"})
> db.users.insert({name:"Raju Sharma", age:77, email:"raju@example.com"})
> db.users.insert({name:"Krishna Yadav", age:65, email:"krishna@example.com"})



#deleteOne

#C:\Program Files\MongoDB\Server\4.0\bin>mongod --dbpath="D:\mongodata"
