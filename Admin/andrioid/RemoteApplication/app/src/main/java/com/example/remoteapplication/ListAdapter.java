package com.example.remoteapplication;

import android.app.Activity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import java.util.ArrayList;

public class  ListAdapter extends ArrayAdapter<String> {
    Activity context;
    ArrayList<Integer> roll;
    ArrayList<String> name;
    ArrayList<String> address;
    public ListAdapter(Activity context, ArrayList<Integer> roll,ArrayList<String> name,ArrayList<String> address)
    {
        super(context,R.layout.datalist,name);
        this.context=context;
        this.roll=roll;
        this.name=name;
        this.address=address;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater inflater=context.getLayoutInflater();
        View row=inflater.inflate(R.layout.datalist,null,true);
        TextView txtroll=row.findViewById(R.id.roll);
        TextView txtname=row.findViewById(R.id.name);
        TextView txtaddress=row.findViewById(R.id.address);

        txtroll.setText(roll.get(position).toString());
        txtname.setText(name.get(position).toString());
        txtaddress.setText(address.get(position).toString());
        return row;
    }
}
