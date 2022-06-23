package com.example.merosahayatri.data;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import androidx.annotation.Nullable;

public class MyDbHandler extends SQLiteOpenHelper {

    public static final String DBNAME = "Login.db"; // to set database name in mysqlite database

    public MyDbHandler(Context context){
        super(context, "Login.db", null, 1); //calling database name
    }

    @Override
    public void onCreate(SQLiteDatabase MyDB) {
        MyDB.execSQL(
                "Create table users(username text primary key,password text,email text)"
        ); // execSQL - Execute a single SQL statement that is NOT a SELECT or any other SQL statement that returns data.
    }

    @Override
    public void onUpgrade(SQLiteDatabase MyDB, int i, int i1) {
        MyDB.execSQL("Drop table if exists users");
    }

    public boolean insertData(String username,String password,String email)
    {
        SQLiteDatabase MyDB = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put("username",username);
        contentValues.put("password",password);
        contentValues.put("email",email);
        long result = MyDB.insert("users",null,contentValues);
        if(result == -1)
            return false;
        else
            return true;
    }
    public boolean checkUsername(String username)
    {
        SQLiteDatabase MyDB = this.getWritableDatabase();
        Cursor cursor = MyDB.rawQuery("Select * from users where username = ?",new String[] {username});
        if(cursor.getCount()>0)
            return true;
        else
            return false;
    }

    public boolean checkUsernamePassword(String username,String password)
    {
        SQLiteDatabase MyDB = this.getWritableDatabase();
        Cursor cursor = MyDB.rawQuery("Select * from users where username=? and password=?",new String[] {username,password});
        if(cursor.getCount()>0)
            return true;
        else
            return false;
    }
}
