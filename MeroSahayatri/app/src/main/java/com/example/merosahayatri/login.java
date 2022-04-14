package com.example.merosahayatri;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.merosahayatri.data.MyDbHandler;

public class login extends AppCompatActivity {

    EditText username,password;
    Button btnlogin;
    MyDbHandler DB;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        username = findViewById(R.id.loginUsername);
        password = findViewById(R.id.loginPassword);
        btnlogin = findViewById(R.id.btnLogin);
        DB = new MyDbHandler(this);

        btnlogin.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View view)
            {
                String user = username.getText().toString();
                String pass = password.getText().toString();

                if(user.equals("") || pass.equals(""))
                {
                    Toast.makeText(login.this, "Please enter all the fields.", Toast.LENGTH_SHORT).show();
                }
                else
                {
                    Boolean checkuserpass = DB.checkUsernamePassword(user,pass);
                    if(checkuserpass==true)
                    {
                        Toast.makeText(login.this, "Sign in Successfully", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(getApplicationContext(),Map.class);
                        startActivity(intent);
                    }
                    else
                    {
                        Toast.makeText(login.this, "Invalid Sign in", Toast.LENGTH_SHORT).show();
                    }
                }
            }
        });
    }

    public void SignUp(View view)
    {
        Intent intent = new Intent(this,register.class);
        startActivity(intent);

    }


}