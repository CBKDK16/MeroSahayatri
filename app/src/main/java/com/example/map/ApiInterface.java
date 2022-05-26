package com.example.map;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Query;

public interface ApiInterface {

    @GET("maps/api/directions/json")
    Call<Result> getDirection(@Query("mode") String mode,
                              @Query("transit_routing_preferance") String preferance,
                              @Query("origin") String origin,
                              @Query("destination") String destination,
                              @Query("key") String key);
}
