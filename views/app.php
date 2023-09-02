<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerenciador de Faturas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"
            integrity="sha512-G8JE1Xbr0egZE5gNGyUm1fF764iHVfRXshIoUWCTPAbKkkItp/6qal5YAHXrxEu4HNfPTQs6HOu3D5vCGS1j3w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<div class="w-full min-h-screen bg-gray-50">
    <div class="py-10 bg-blue-600">
        <div class="w-[90%] lg:w-[60%] mx-auto flex justify-between items-center text-white">
            <p class="font-bold text-xl">HarveControl</p>
        </div>
    </div>
    <div class="py-[80px] bg-blue-600"></div>
    <div class="space-y-10 -mt-40  pb-10">
        <div class="w-[90%] lg:w-[60%] mx-auto bg-white shadow border border-gray-100 rounded">
            <div class="w-full flex justify-between items-center p-6">
                <h2 class="text-gray-500 font-bold text-xs">Balanço</h2>
                <div class="">
                    <button class="text-xs font-medium text-white bg-blue-500 rounded transition-color duration-300 hover:bg-blue-500 px-4 py-2">
                        Nova Fatura
                    </button>
                </div>
            </div>
            <div class="relative w-full p-2">
                <canvas id="balanceChart"></canvas>
            </div>
        </div>

        <div class="space-y-5 w-[90%] lg:w-[60%] mx-auto">
            <div class="flex justify-between ">
                <h2 class="font-bold text-gray-400">Últimos lançamentos</h2>
            </div>
            <div class="flex items-center justify-between  bg-white shadow border-l-4 border-l-red-400 rounded px-4 py-4">
                <div class="">

                    <h5 class="font-medium text-xs text-gray-500">Conta de água + Esgoto</h5>
                    <p class="text-[8px] text-gray-500">Vencimento: 30/08/2023</p>

                </div>
                <div class="flex gap-2 ">
                    <span class="flex bg-red-50 text-red-400 rounded px-2 py-1 font-medium text-xs">R$ 80,00</span>
                    <button class="bg-green-50 text-green-500 rounded hover:bg-green-100 py-1 px-2">
                        <i class="fa-regular fa-thumbs-up"></i>
                    </button>

                </div>
            </div>

            <div class="flex items-center justify-between mx-auto bg-white shadow border-l-4 border-l-green-400 rounded px-4 py-4">
                <div class="">
                    <h5 class="font-medium text-xs text-gray-500">Desenvolvimento de Site</h5>
                    <p class="text-[8px] text-gray-500">Recebimento: 30/08/2023</p>
                </div>

                <div class="flex gap-2 ">
                    <span class="flex bg-green-50 text-green-400 rounded px-2 py-1 font-medium text-xs">R$ 1.200,00</span>
                    <button class="bg-green-50 text-green-500 rounded hover:bg-green-100 py-1 px-2">
                        <i class="fa-regular fa-thumbs-up"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="module" src="/js/app.js"></script>
</body>
</html>