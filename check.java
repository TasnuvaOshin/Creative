package com.baymaxbd.baymaxdriver.Home.Earning;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TabHost;
import android.widget.TextView;
import android.widget.Toast;

import com.baymaxbd.baymaxdriver.API.ApiResponse.Earnings.earningDataResponse;
import com.baymaxbd.baymaxdriver.API.ApiResponse.Earnings.earningResponse;
import com.baymaxbd.baymaxdriver.API.OurClient;
import com.baymaxbd.baymaxdriver.Connection.getRetrofitInstance;
import com.baymaxbd.baymaxdriver.Home.Earning.Recyclerview.earningAdapter;
import com.baymaxbd.baymaxdriver.Payment.withdrawPage.withdrawNowFragment;
import com.baymaxbd.baymaxdriver.R;

import java.util.Calendar;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentTransaction;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;


public class EarningFragment extends Fragment implements View.OnClickListener {

    private TabHost host;
    private ImageButton ib_filter;
    private LinearLayout search_date; //filter layout
    private int searching = 0;
    private RecyclerView rv_complete, rv_pending, rv_due;
    private SharedPreferences pref;
    private String user_token;
    private Retrofit retrofit;
    private OurClient ourClient;
    private Map<String, String> dataComplete, dataPending, datDue;
    private TextView tv_total_complete, tv_total_pending, tv_total_due, from_date_complete, to_date_complete;
    private ImageButton ib_search_complete;
    private Button bt_seven_complete, bt_fifteen_complete, bt_thirty_complete;
    private LinearLayout withdraw, no_earning, no_pending, no_due;
    int i;
    private AlertDialog searchAlert;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.new_earning_layout, container, false);
        host = view.findViewById(R.id.tabHost);
        ib_filter = view.findViewById(R.id.ib_filter);
        search_date = view.findViewById(R.id.search_date);
        rv_complete = view.findViewById(R.id.rv_complete);
        rv_due = view.findViewById(R.id.rv_due);
        rv_pending = view.findViewById(R.id.rv_pending);
        tv_total_complete = view.findViewById(R.id.tv_total_complete); //generic show how much pending or how much due etc
        tv_total_pending = view.findViewById(R.id.tv_total_pending);
        tv_total_due = view.findViewById(R.id.tv_total_due);
        from_date_complete = view.findViewById(R.id.from_date_complete);
        to_date_complete = view.findViewById(R.id.to_date_complete);
        ib_search_complete = view.findViewById(R.id.ib_search_complete);
        bt_seven_complete = view.findViewById(R.id.bt_seven_complete);
        bt_fifteen_complete = view.findViewById(R.id.bt_fifteen_complete);
        bt_thirty_complete = view.findViewById(R.id.bt_thirteen_complete);
        rv_complete.setHasFixedSize(true);
        rv_pending.setHasFixedSize(true);
        rv_due.setHasFixedSize(true);
        rv_complete.setLayoutManager(new LinearLayoutManager(getActivity()));
        rv_pending.setLayoutManager(new LinearLayoutManager(getActivity()));
        rv_due.setLayoutManager(new LinearLayoutManager(getActivity()));
        ib_filter.setOnClickListener(this);
        from_date_complete.setOnClickListener(this);
        to_date_complete.setOnClickListener(this);
        ib_search_complete.setOnClickListener(this);
        bt_fifteen_complete.setOnClickListener(this);
        bt_thirty_complete.setOnClickListener(this);
        bt_seven_complete.setOnClickListener(this);
        dataComplete = new HashMap<>();
        dataPending = new HashMap<>();
        datDue = new HashMap<>();
        pref = getActivity().getApplicationContext().getSharedPreferences("MyPref", 0);
        user_token = pref.getString("user_token", "");
        retrofit = new getRetrofitInstance().GetConnection();
        ourClient = retrofit.create(OurClient.class);
        dataComplete.put("complete", "1");
        dataPending.put("pending", "1");
        datDue.put("due", "1");
        withdraw = view.findViewById(R.id.withdraw);
        withdraw.setOnClickListener(this);
        Log.d("user_token", user_token);
        no_due = view.findViewById(R.id.no_due);
        no_earning = view.findViewById(R.id.no_earning);
        no_pending = view.findViewById(R.id.no_pending);
        getEarnings(dataComplete, rv_complete, no_earning);
        host.setup();
        //Tab 1
        TabHost.TabSpec spec = host.newTabSpec("Completed");
        spec.setContent(R.id.tab1);
        spec.setIndicator("Completed");
        host.addTab(spec);

        //Tab 2
        spec = host.newTabSpec("Pending");
        spec.setContent(R.id.tab2);
        spec.setIndicator("Pending");
        host.addTab(spec);

        //Tab 3
        spec = host.newTabSpec("Due");
        spec.setContent(R.id.tab3);
        spec.setIndicator("Due");
        host.addTab(spec);

//default call complete

        host.setOnTabChangedListener(new TabHost.OnTabChangeListener() {
            @Override
            public void onTabChanged(String tabId) {

               i = host.getCurrentTab();

                if (i == 0) {
                    // your method 1
                    getEarnings(dataComplete, rv_complete, no_earning);

                    // Toast.makeText(getActivity(), "1", Toast.LENGTH_SHORT).show();

                } else if (i == 1) {
                    //Toast.makeText(getActivity(), "2", Toast.LENGTH_SHORT).show();
                    //call pending
                    getEarnings(dataPending, rv_pending, no_pending);

                    // your method 2
                } else {

                    //call due
                    //  Toast.makeText(getActivity(), "3", Toast.LENGTH_SHORT).show();
                    getEarnings(datDue, rv_due, no_due);
                }
            }
        });

        return view;
    }

    //todo this page will be changes and more specific
    private void getEarnings(Map<String, String> data, final RecyclerView recyclerView, final LinearLayout linearLayout) {
        Call<earningResponse> completeResponse = ourClient.GetEarning(user_token, data);
        completeResponse.enqueue(new Callback<earningResponse>() {
            @SuppressLint("SetTextI18n")
            @Override
            public void onResponse(Call<earningResponse> call, Response<earningResponse> response) {
                if (response.code() == 200) {
                    String value = response.body().getTotal();
                    Log.d("total", response.body().getTotal());
                    tv_total_complete.setText("Total  " + value + " BDT");
                    Log.d("response", String.valueOf(response.code()));
                    Log.d("response", String.valueOf(response.body().getTotal()));
                    List<earningDataResponse> data = response.body().getData();

                    Log.d("size", String.valueOf(data.size()));
                    if (response.body().getData().size() > 0) {
                        recyclerView.setVisibility(View.VISIBLE);
                        linearLayout.setVisibility(View.GONE);
                        recyclerView.setAdapter(new earningAdapter(data, getActivity()));
                        //   Log.d("test", data.get(0).getTrip_id());
                    } else {
                        linearLayout.setVisibility(View.VISIBLE);
                        recyclerView.setVisibility(View.GONE);

                    }


                } else {
                    //  Toast.makeText(getActivity(), "No Result Found", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<earningResponse> call, Throwable t) {
                Log.d("response", String.valueOf(t));
            }
        });
    }


    @Override
    public void onClick(View view) {
        switch (view.getId()) {

            case R.id.ib_filter:
                if (searching == 0) {

                    ib_filter.setImageResource(R.drawable.ic_filter_list_red_24dp);
                    searching++;
                } else {

                    ib_filter.setImageResource(R.drawable.ic_filter_list_black_24dp);

                    searching = 0;
                }
                break;

            case R.id.from_date_complete:
                SetDate(from_date_complete);
                break;

            case R.id.to_date_complete:
                SetDate(to_date_complete);
                break;


            case R.id.ib_search_complete:
                dataComplete.put("start_date", from_date_complete.getText().toString());
                dataComplete.put("end_date", to_date_complete.getText().toString());
                getEarnings(dataComplete, rv_complete, no_earning);
                break;

            case R.id.bt_seven_complete:
                getDayWiseHistory(7);
                break;
            case R.id.bt_fifteen_complete:
                getDayWiseHistory(15);
                break;

            case R.id.bt_thirteen_complete:
                getDayWiseHistory(30);
                break;

            case R.id.withdraw:
                CheckWithDrawAvailability();
                break;


        }
    }

    private void CheckWithDrawAvailability() {
        ourClient.GetEarning(user_token, dataPending).enqueue(new Callback<earningResponse>() {
            @Override
            public void onResponse(Call<earningResponse> call, Response<earningResponse> response) {
                final Double totalPending = Double.valueOf(response.body().getTotal());

                ourClient.GetEarning(user_token, datDue).enqueue(new Callback<earningResponse>() {
                    @Override
                    public void onResponse(Call<earningResponse> call, Response<earningResponse> response) {
                        Double totalDue = Double.valueOf(response.body().getTotal());

                        if ((totalPending - totalDue) > 999) {

                            //to go withdraw amount page
                        } else {
                            //todo testing
                            // ShowAlert();
                            SetFragment(new withdrawNowFragment());

                        }
                    }

                    @Override
                    public void onFailure(Call<earningResponse> call, Throwable t) {

                    }
                });
            }

            @Override
            public void onFailure(Call<earningResponse> call, Throwable t) {

            }
        });
    }

    private void getDayWiseHistory(int i) {
        dataComplete.clear();
        dataComplete.put("complete", "1");
        dataComplete.put("day", String.valueOf(i));
        getEarnings(dataComplete, rv_complete, no_earning);
    }

    private void SetDate(final TextView textView) {
        Calendar calendar = Calendar.getInstance();
        int day = calendar.get(Calendar.DAY_OF_MONTH);
        int month = calendar.get(Calendar.MONTH);
        int year = calendar.get(Calendar.YEAR);
        DatePickerDialog datePickerDialog = new DatePickerDialog(getActivity(), android.R.style.Theme_Holo_Light_Dialog_MinWidth, new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker datePicker, int year, int month, int day) {
                String dob = (year + "-" + (month + 1) + "-" + day);

                textView.setText(dob);
            }
        }, day, month, year);

        datePickerDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        datePickerDialog.getDatePicker().setMinDate(1577815200000L);
        datePickerDialog.getDatePicker().setMaxDate(Calendar.getInstance().getTimeInMillis());
        datePickerDialog.show();
    }


    private void SetFragment(Fragment fragment) {
        FragmentTransaction fragmentTransaction = getActivity().getSupportFragmentManager().beginTransaction();
        fragmentTransaction.replace(R.id.frame_layout, fragment);
        fragmentTransaction.commit();

    }
    private void ShowSearchDialogue() {
        searchAlert = new AlertDialog.Builder(getActivity()).create();
        LayoutInflater layoutInflater = LayoutInflater.from(getActivity());
        View promptView = layoutInflater.inflate(R.layout.search_alert, null);
        ImageButton from = promptView.findViewById(R.id.from);
        ImageButton to = promptView.findViewById(R.id.to);
        ImageButton close = promptView.findViewById(R.id.ok);
        final TextView tv_from = promptView.findViewById(R.id.tv_from);
        final TextView tv_to = promptView.findViewById(R.id.tv_to);
        Button search = promptView.findViewById(R.id.search);

        close.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                searchAlert.dismiss();
            }
        });

        to.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                final Calendar calendar = Calendar.getInstance();
                int yy = calendar.get(Calendar.YEAR);
                int mm = calendar.get(Calendar.MONTH);
                int dd = calendar.get(Calendar.DAY_OF_MONTH);
                DatePickerDialog datePicker = new DatePickerDialog(getActivity(), new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                        String date = String.valueOf(dayOfMonth) + "/" + String.valueOf(monthOfYear + 1)
                                + "/" + String.valueOf(year);
                        tv_to.setText(date);
                    }
                }, yy, mm, dd);
                datePicker.show();
            }
        });


        to.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                final Calendar calendar = Calendar.getInstance();
                int yy = calendar.get(Calendar.YEAR);
                int mm = calendar.get(Calendar.MONTH);
                int dd = calendar.get(Calendar.DAY_OF_MONTH);
                DatePickerDialog datePicker = new DatePickerDialog(getActivity(), new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                        String date = year+"-"+(monthOfYear+1)+"-"+dayOfMonth;
                        tv_to.setText(date);
                    }
                }, yy, mm, dd);
                datePicker.show();
            }
        });

        from.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                final Calendar calendar = Calendar.getInstance();
                int yy = calendar.get(Calendar.YEAR);
                int mm = calendar.get(Calendar.MONTH);
                int dd = calendar.get(Calendar.DAY_OF_MONTH);
                DatePickerDialog datePicker = new DatePickerDialog(getActivity(), new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {

                        String date = year+"-"+(monthOfYear+1)+"-"+dayOfMonth;
                        tv_from.setText(date);
                    }
                }, yy, mm, dd);
                datePicker.show();
            }
        });
        search.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!TextUtils.isEmpty(tv_from.getText().toString()) && !TextUtils.isEmpty(tv_to.getText().toString())) {
                    searchAlert.dismiss();
                    
                    if(i == 0){
                        dataComplete.put("start_date", from_date_complete.getText().toString());
                        dataComplete.put("end_date", to_date_complete.getText().toString());
                        getEarnings(dataComplete, rv_complete, no_earning);
                    }else if( i == 1){
                        
                    }
                   
                } else {
                    Toast.makeText(getActivity(), "Please Select Dates", Toast.LENGTH_SHORT).show();
                }
            }
        });
        searchAlert.getWindow().setBackgroundDrawable(new ColorDrawable(android.graphics.Color.TRANSPARENT));
        searchAlert.setCancelable(false);
        searchAlert.setView(promptView);
        searchAlert.show();
    }
}
