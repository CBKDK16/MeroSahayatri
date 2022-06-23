package com.example.merosahayatri;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.merosahayatri.data.MyDbHandler;

import java.util.HashMap;

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

//        if(user.equals("") || pass.equals("") || repass.equals("") || emai.equals(""))
//        {
//            Toast.makeText(this, "Please Enter all the fields.", Toast.LENGTH_SHORT).show();
//        }
//        else
//        {
//            if(pass.equals(repass))
//            {
//                Boolean checkUser = DB.checkUsername(user);
//                if(checkUser == false)
//                {
//                    Boolean insert = DB.insertData(user,pass,emai);
//                    if(insert ==true)
//                    {
//                        Toast.makeText(this, "Register Successfully", Toast.LENGTH_SHORT).show();
//                    }
//                    else
//                    {
//                        Toast.makeText(this,"Registration Failed",Toast.LENGTH_SHORT).show();
//                    }
//                }
//                else
//                {
//                    Toast.makeText(this, "User already exists ! Please Sign in.", Toast.LENGTH_SHORT).show();
//                }
//            }
//            else
//            {
//                Toast.makeText(this, "Password not matching.", Toast.LENGTH_SHORT).show();
//            }
//        }

        register.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View view)
            {
                String url = "http://192.168.0.110/merosahayatri/Admin/setData.php";
                StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                Toast.makeText(register.this, response.trim(), Toast.LENGTH_SHORT).show();
                                Toast.makeText(register.this, "Register Successfully", Toast.LENGTH_SHORT).show();
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(register.this, error.toString(), Toast.LENGTH_SHORT).show();
                            }
                        })
                        {
                            @Override
                            protected HashMap<String,String> getParams(){
                                HashMap<String,String> params = new HashMap<String,String>();
                                params.put("username",user);
                                params.put("password",pass);
                                params.put("email",emai);
                                return params;
                            }
                        };
                RequestQueue requestQueue = Volley.newRequestQueue(register.this);
                requestQueue.add(stringRequest);
                Intent intent = new Intent(getApplicationContext(), com.example.merosahayatri.login.class);
                startActivity(intent);
            }
        });

    }
}