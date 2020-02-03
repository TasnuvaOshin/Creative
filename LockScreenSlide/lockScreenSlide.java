package com.baymaxbd.baymaxdriver.Debug;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.animation.AlphaAnimation;
import android.view.animation.Animation;
import android.view.animation.AnimationSet;
import android.widget.SeekBar;
import android.widget.TextView;
import android.widget.Toast;

import com.baymaxbd.baymaxdriver.R;

public class DebugActivity extends AppCompatActivity {
private SeekBar seekBar;
private TextView seek_text;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_debug);
         seekBar = findViewById(R.id.myseek);
         seek_text = findViewById(R.id.seek_text);

        final Animation in = new AlphaAnimation(0.0f, 1.0f);
        in.setDuration(4000);
        final Animation out = new AlphaAnimation(1.0f, 0.0f);
        out.setDuration(3000);

        seekBar.setOnSeekBarChangeListener(new SeekBar.OnSeekBarChangeListener() {
            @Override
            public void onStopTrackingTouch(SeekBar seekBar) {

                if (seekBar.getProgress() > 95) {


                } else {
                    seekBar.setProgress(0);
                    seekBar.setThumb(getResources().getDrawable(R.drawable.arrow_sign));
                }

            }

            @Override
            public void onStartTrackingTouch(SeekBar seekBar) {
                seek_text.startAnimation(in);

            }

            @Override
            public void onProgressChanged(SeekBar seekBar, int progress,
                                          boolean fromUser) {
                if(progress>95){
                    seekBar.setThumb(getResources().getDrawable(R.drawable.red_drop));


                }else {

                    seekBar.setThumb(getResources().getDrawable(R.drawable.arrow_sign));
                }

            }
        });



    }
}
