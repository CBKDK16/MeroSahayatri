package com.example.remoteapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.widget.ListView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {

    ListView list;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        list=findViewById(R.id.listitem);
        volleyRequest();
    }

    private void volleyRequest() {
        RequestQueue queue= Volley.newRequestQueue(this);
        String url="http://10.0.2.2/Example/Getdata.php";
        StringRequest stringRequest=new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        DecodeJson(response);
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("Exceptoion",error.toString());
            }
        });
        queue.add(stringRequest);

    }

    private void DecodeJson(String response) {
        try {
            ArrayList<Integer> roll=new ArrayList<>();
            ArrayList<String> name=new ArrayList<>();
            ArrayList<String> address=new ArrayList<>();
            JSONObject result=new JSONObject(response);
            JSONArray data=result.getJSONArray("data");
            for (int i=0;i<data.length();i++)
            {
                JSONObject student=data.getJSONObject(i);
                roll.add(student.getInt("roll"));
                name.add(student.getString("name"));
                address.add(student.getString("address"));
                //Log.d("Row"+i," Roll="+roll+" name="+name+" Address="+address);
            }
            ListAdapter adapter=new ListAdapter(this,roll,name,address);
            list.setAdapter(adapter);

        }catch (Exception ex){}
    }
}