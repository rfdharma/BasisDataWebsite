<x-app-layout>
    <div class="container mx-auto pt-6">

        <div class="mb-6 grid grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Most Penalized Car</h2>
                <p class="text-3xl font-bold text-center">{{$carNameWithHighestPenalty}}</p>
            </div>

            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Top Average Revenue Car</h2>
                <p class="text-3xl font-bold text-center">{{$topRevenueCar}}</p>
            </div>


            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Total Revenues</h2>
                <p class="text-3xl font-bold text-center">{{$totalrevenues}}</p>
            </div>


        </div>

        <div class="mb-6">
            <div class="p-6 bg-white rounded shadow">
                {!! $topRentCar->container() !!}
            </div>
        </div>
        <div class="mb-6">
            <div class="p-6 bg-white rounded shadow">
                {!! $revenuesNameCarChart->container() !!}
            </div>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-6">

            <div class="p-6 bg-white rounded shadow">
                {!! $rentFeeHappened->container() !!}
            </div>
            <div class="p-6 bg-white rounded shadow">
                {!! $revenuesBrandCarChart->container() !!}
            </div>
        </div>

        <div class="mb-6 grid grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded shadow">
                {!! $RentbyBrandChart->container() !!}
            </div>
            <div class="p-6 bg-white rounded shadow">
                {!! $RentbyDateChart->container() !!}
            </div>
            <div class="p-6 bg-white rounded shadow">
                {!! $RentbyTypeChart->container() !!}
            </div>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-6">
            <div class="mb-6">
                <div class="p-6 bg-white rounded shadow">
                    {!! $feeProfitCar->container() !!}
                </div>
            </div>

            <div class="mb-6">
                <div class="p-6 bg-white rounded shadow">
                    {!! $feeProfitBrandCar->container() !!}
                </div>
            </div>

        </div>




    </div>

    <!-- Include LarapexCharts library -->
    <script src="{{ $revenuesBrandCarChart->cdn() }}"></script>
    <script src="{{ $revenuesNameCarChart->cdn() }}"></script>
    <script src="{{ $RentbyBrandChart->cdn() }}"></script>
    <script src="{{ $RentbyTypeChart->cdn() }}"></script>
    <script src="{{ $RentbyDateChart->cdn() }}"></script>
    <script src="{{ $rentFeeHappened->cdn() }}"></script>
    <script src="{{ $topRentCar->cdn() }}"></script>
    <script src="{{ $feeProfitCar->cdn() }}"></script>
    <script src="{{ $feeProfitBrandCar->cdn() }}"></script>


    <!-- Render the charts using the scripts provided by LarapexCharts -->
    {!! $revenuesBrandCarChart->script() !!}
    {!! $revenuesNameCarChart->script() !!}
    {!! $RentbyBrandChart->script() !!}
    {!! $RentbyTypeChart->script() !!}
    {!! $RentbyDateChart->script() !!}
    {!! $rentFeeHappened->script() !!}
    {!! $topRentCar->script() !!}
    {!! $feeProfitCar->script() !!}
    {!! $feeProfitBrandCar->script() !!}

</x-app-layout>
