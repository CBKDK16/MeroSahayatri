package com.example.merosahayatri;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;

import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.merosahayatri.data.MyDbHandler;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;

public class login extends AppCompatActivity {

    EditText etusername,etpassword;
    Button btnlogin;
    String username1,password1;
    MyDbHandler DB;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        username1 = password1 = "";
        etusername = findViewById(R.id.loginUsername);
        etpassword = findViewById(R.id.loginPassword);
        btnlogin = findViewById(R.id.btnLogin);
        DB = new MyDbHandler(this);


        btnlogin.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View view)
            {

                username1 = etusername.getText().toString();
                password1 = etpassword.getText().toString();
                if(!username1.equals("") && !password1.equals(""))
                {
                    volleyrequest();
                }
                else
                {
                    Toast.makeText(login.this, "Field Cannot be empty!", Toast.LENGTH_SHORT).show();
                }


//                if(username.equals("") || password.equals(""))
//                {
//                    Toast.makeText(login.this, "Please enter all the fields.", Toast.LENGTH_SHORT).show();
//                }
//                else
//                {
//                    Boolean checkuserpass = DB.checkUsernamePassword(user,pass);
//                    if(checkuserpass==true)
//                    {
//                        Toast.makeText(login.this, "Sign in Successfully", Toast.LENGTH_SHORT).show();
//                        Intent intent = new Intent(getApplicationContext(),Map.class);
//                        startActivity(intent);
//                    }
//                    else
//                    {
//                        Toast.makeText(login.this, "Invalid Sign in", Toast.LENGTH_SHORT).show();
//                    }
//                }
//
            }
        });
    }

    public void SignUp(View view)
    {
        Intent intent = new Intent(this,register.class);
        startActivity(intent);

    }
    public void volleyrequest() {
        String url = "http://192.168.0.109/merosahayatri/Admin/getdata.php";
        RequestQueue requestQueue;
        requestQueue = Volley.newRequestQueue(this);

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET,
                url, null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                            try {
                                for(int i=0;i< response.length();i++)
                                {
                                    JSONObject obj = null;
                                    obj = response.getJSONObject(i);
                                    if(username1.equals(obj.getString("username")) && password1.equals(obj.getString("password")))
                                    {
                                        Toast.makeText(login.this, "Sign in Successfully", Toast.LENGTH_SHORT).show();
                                        Intent intent = new Intent(getApplicationContext(), com.example.merosahayatri.MapsActivity.class);
                                        startActivity(intent);
                                    }
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(login.this, "Something went wrong", Toast.LENGTH_SHORT).show();
                    }
                }
        );
        requestQueue.add(jsonArrayRequest);
    }
}