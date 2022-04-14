package com.example.merosahayatri;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.example.merosahayatri.data.MyDbHandler;

public class register extends AppCompatActivity {

    EditText username,email,password,confirmPassword;
    TextView login;
    Button register;
    MyDbHandler DB;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        username = findViewById(R.id.username);
        email = findViewById(R.id.email);
        password = findViewById(R.id.password);
        confirmPassword = findViewById(R.id.confirmPassword);
        register = findViewById(R.id.register);
        login = findViewById(R.id.btnlogin);
        DB = new MyDbHandler(this);


    }
    public void login(View view)
    {
        Intent intent = new Intent(this, com.example.merosahayatri.login.class);
        startActivity(intent);
    }
    public void register(View view)
    {
        String user = username.getText().toString();
        String pass = password.getText().toString();
        String repass = confirmPassword.getText().toString();
        String emai = email.getText().toString();

        if(user.equals("") || pass.equals("") || repass.equals("") || emai.equals(""))
        {
            Toast.makeText(this, "Please Enter all the fields.", Toast.LENGTH_SHORT).show();
        }
        else
        {
            if(pass.equals(repass))
            {
                Boolean checkUser = DB.checkUsername(user);
                if(checkUser == false)
                {
                    Boolean insert = DB.insertData(user,pass,emai);
                    if(insert ==true)
                    {
                        Toast.makeText(this, "Register Successfully", Toast.LENGTH_SHORT).show();
                    }
                    else
                    {
                        Toast.makeText(this,"Registration Failed",Toast.LENGTH_SHORT).show();
                    }
                }
                else
                {
                    Toast.makeText(this, "User already exists ! Please Sign in.", Toast.LENGTH_SHORT).show();
                }
            }
            else
            {
                Toast.makeText(this, "Password not matching.", Toast.LENGTH_SHORT).show();
            }
        }
        Intent intent = new Intent(this, com.example.merosahayatri.login.class);
        startActivity(intent);
    }
}