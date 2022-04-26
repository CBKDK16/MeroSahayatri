package com.example.remoteapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;

public class MainActivity2 extends AppCompatActivity {
EditText redt,nedt,aedt;
Button ibtn;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);
        redt=findViewById(R.id.sroll);
        nedt=findViewById(R.id.sname);
        aedt=findViewById(R.id.saddress);
        ibtn=findViewById(R.id.insertbtn);
        ibtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                volleyRequest();
                Intent intent = new Intent(getApplicationContext(),MainActivity.class);
                startActivity(intent);
            }
        });
    }

    private void volleyRequest() {
        RequestQueue queue= Volley.newRequestQueue(this);
        String url="http://192.168.0.112/merosahayatri/Admin/andrioid/Example/Setdata.php";
        StringRequest stringRequest=new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Toast.makeText(getApplicationContext(), response, Toast.LENGTH_SHORT).show();
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("Exception",error.toString());
            }

        }){
            public HashMap<String,String> getParams()
            {
                aMap<String, String> param= new HashMap<>();
                param.put("name",nedt.getText().toString());
                param.put("address",aedt.getText().toString());
                return param;
            }
        };
        queue.add(stringRequest);


    }
}