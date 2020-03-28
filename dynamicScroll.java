
    @Override
    public void onClick(View view) {
        switch (view.getId()) {

            case R.id.floatMeUp:
              //  flowUp();
                break;

            case R.id.floatMeDown:
              //  flowDown();
                break;
        }
    }

    private void flowDown() {
        final RelativeLayout relativeLayout = view.findViewById(R.id.view);
        view.findViewById(R.id.floatMeUp).setVisibility(View.VISIBLE);
// getting the layoutparams might differ in your application, it depends on the parent layout
        RelativeLayout.LayoutParams lp = (RelativeLayout.LayoutParams) relativeLayout.getLayoutParams();
        ResizeAnimation a = new ResizeAnimation(relativeLayout);
        a.setDuration(1000);

// set the starting height (the current height) and the new height that the view should have after the animation
        a.setParams(lp.height, 860);
        view.findViewById(R.id.top).setVisibility(View.VISIBLE);
        view.findViewById(R.id.pager).setVisibility(View.VISIBLE);
        relativeLayout.startAnimation(a);
        ObjectAnimator colorFade = ObjectAnimator.ofObject(relativeLayout, "backgroundColor", new ArgbEvaluator(), Color.argb(84, 215, 29, 55), 0xFFFFFF);
        colorFade.setDuration(1000);
        colorFade.start();

        view.findViewById(R.id.floatMeDown).setVisibility(View.GONE);
        view.findViewById(R.id.offer_top).setVisibility(View.GONE);

    }

    private void flowUp() {
        final RelativeLayout relativeLayout = view.findViewById(R.id.view);
        view.findViewById(R.id.floatMeUp).setVisibility(View.GONE);
// getting the layoutparams might differ in your application, it depends on the parent layout
        RelativeLayout.LayoutParams lp = (RelativeLayout.LayoutParams) relativeLayout.getLayoutParams();
        ResizeAnimation a = new ResizeAnimation(relativeLayout);
        a.setDuration(1000);

// set the starting height (the current height) and the new height that the view should have after the animation
        a.setParams(lp.height, 340);
        view.findViewById(R.id.top).setVisibility(View.GONE);
        view.findViewById(R.id.pager).setVisibility(View.GONE);
        relativeLayout.startAnimation(a);
        ObjectAnimator colorFade = ObjectAnimator.ofObject(relativeLayout, "backgroundColor", new ArgbEvaluator(), Color.argb(84, 215, 29, 55), 0xFFE92B45);
        colorFade.setDuration(1000);
        colorFade.start();

        view.findViewById(R.id.floatMeDown).setVisibility(View.VISIBLE);
        view.findViewById(R.id.offer_top).setVisibility(View.VISIBLE);

    }


    private void init() {
        for (int i = 0; i < IMAGES.length; i++)
            ImagesArray.add(IMAGES[i]);

        mPager = (ViewPager) view.findViewById(R.id.pager);


        mPager.setAdapter(new slidingImageAdapter(ImagesArray, getActivity()));


        final float density = getResources().getDisplayMetrics().density;


        NUM_PAGES = IMAGES.length;

        // Auto start of viewpager
        final Handler handler = new Handler();
        final Runnable Update = new Runnable() {
            public void run() {
                if (currentPage == NUM_PAGES) {
                    currentPage = 0;
                }
                mPager.setCurrentItem(currentPage++, true);
            }
        };
        Timer swipeTimer = new Timer();
        swipeTimer.schedule(new TimerTask() {
            @Override
            public void run() {
                handler.post(Update);
            }
        }, 3000, 3000);

    }
