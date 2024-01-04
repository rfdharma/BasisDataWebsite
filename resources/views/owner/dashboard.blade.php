<x-app-layout>
    <div class="container mx-auto pt-6">

        <div class="mb-6 grid grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Total Brands</h2>
                <p class="text-3xl font-bold text-center">{{$totalBrand}}</p>
            </div>

            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Total Types</h2>
                <p class="text-3xl font-bold text-center">{{$totalType}}</p>
            </div>

            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Total Units</h2>
                <p class="text-3xl font-bold text-center">{{$totalUnit}}</p>
            </div>
        </div>


        <div class="mb-6">
            <div class="p-6 bg-white rounded shadow">
                {!! $unitCarNameChart->container() !!}
            </div>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-6">
            <div class="p-6 bg-white rounded shadow">
                {!! $BrandCarChart->container() !!}
            </div>

            <div class="p-6 bg-white rounded shadow">
                {!! $TypeCarChart->container() !!}
            </div>

        </div>

        <div class="mb-6 grid grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded shadow">
                {!! $carYearCountChart->container() !!}
            </div>

            <div class="p-6 bg-white rounded shadow">
                {!! $carCapacityChart->container() !!}
            </div>

            <div class="p-6 bg-white rounded shadow">
                {!! $carTransmissionCountChart->container() !!}
            </div>
        </div>

        <div class="mb-6 grid grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded shadow">
                {!! $barCarYear->container() !!}
            </div>

            <div class="p-6 bg-white rounded shadow">
                {!! $barCarCapacity->container() !!}
            </div>

            <div class="p-6 bg-white rounded shadow">
                {!! $barCarTransmission->container() !!}
            </div>

        </div>
    </div>

    <!-- Include LarapexCharts library -->
    <script src="{{ $unitCarNameChart->cdn() }}"></script>
    <script src="{{ $carYearCountChart->cdn() }}"></script>
    <script src="{{ $carTransmissionCountChart->cdn() }}"></script>
    <script src="{{ $carCapacityChart->cdn() }}"></script>
    <script src="{{ $BrandCarChart->cdn() }}"></script>
    <script src="{{ $TypeCarChart->cdn() }}"></script>
    <script src="{{ $barCarYear->cdn() }}"></script>
    <script src="{{ $barCarCapacity->cdn() }}"></script>
    <script src="{{ $barCarTransmission->cdn() }}"></script>

    <!-- Render the charts using the scripts provided by LarapexCharts -->
    {!! $unitCarNameChart->script() !!}
    {!! $carYearCountChart->script() !!}
    {!! $carCapacityChart->script() !!}
    {!! $carTransmissionCountChart->script() !!}
    {!! $BrandCarChart->script() !!}
    {!! $TypeCarChart->script() !!}
    {!! $barCarYear->script() !!}
    {!! $barCarCapacity->script() !!}
    {!! $barCarTransmission->script() !!}

</x-app-layout>
