// function attachAmountStage1() {
//     var stage1 = document.getElementById('checkStage1Id');
//     var stage2 = document.getElementById('checkStage2Id');
//     var stage2 = document.getElementById('checkStage3Id');

//     var information = document.getElementById('informationId');

//     var stage1Amount = document.getElementById('stage1AmountId');
    
//     var balancedAmount = document.getElementById('balancedAmountId');

//     var amountForStage = document.getElementById('depositAmountId'); 

//     window.onclick = function () {
//         if (stage1Amount >= balancedAmount) {
//             if (stage1.onclick) {
//                 amountForStage.value = '$60';
//                 stage2.disabled;
//                 stage3.disabled;
//             }   
//         } else{
//             information.value = 'You can\'t make'
//         }
//     }
// }

// function attachAmountStage2() {
//     var stage1 = document.getElementById('checkStage1Id');
//     var stage2 = document.getElementById('checkStage2Id');
//     var stage3 = document.getElementById('checkStage3Id');

//     var stage2Amount = document.getElementById('stage2AmountId');
//     var stage3Amount = document.getElementById('stage3AmountId');

//     var balancedAmount = document.getElementById('balancedAmountId');

//     var amountForStage = document.getElementById('depositAmountId'); 

//     if (stage2Amount >= balancedAmount) {
//         if (stage2.onclick) {
//             amountForStage.value = '$120';
//             stage1.disabled;
//             stage3.disabled;
//         }   
//     }
// }

// function attachAmountStage3() {
//     var stage1 = document.getElementById('checkStage1Id');
//     var stage2 = document.getElementById('checkStage2Id');
//     var stage3 = document.getElementById('checkStage3Id');

//     var stage3Amount = document.getElementById('stage3AmountId');

//     var balancedAmount = document.getElementById('balancedAmountId');

//     var amountForStage = document.getElementById('depositAmountId'); 

//     if (stage3Amount >= balancedAmount) {
//         if (stage3.onclick) {
//             amountForStage.value = '$180';
//             stage1.disabled;
//             stage2.disabled;
//         }   
//     } else{

//     }
// }

function attachAmountStage1() {
    var stage1 = document.getElementById('checkStage1Id');
    var stage2 = document.getElementById('checkStage2Id');
    var stage3 = document.getElementById('checkStage3Id');
    
    var selectedPlan = document.getElementById('planId');

    var selectedAmount = document.getElementById('selectValuesId');
    var amountToPay = document.getElementById('paymentOverviewId');

    var amountForStage = document.getElementById('depositAmountId'); 

    window.onclick = function () {
       if (stage1.onclick) {
            // amountForStage.value = '$50';
            selectedPlan.value = 'Stage 1';
            stage1.checked = true;
            stage2.checked = false;
            stage3.checked = false;
        }
    }
    window.onchange = function () {
        if (selectedPlan.value == 'Stage 1') {
            // selectedPlan.value = 'Stage1';
            amountToPay.innerText = 'Overview payment: Amount to pay in is between \$50 and $5000 for starter plan';
        }
    }
}

function attachAmountStage2() {
    var stage1 = document.getElementById('checkStage1Id');
    var stage2 = document.getElementById('checkStage2Id');
    var stage3 = document.getElementById('checkStage3Id');

    var selectedPlan = document.getElementById('planId');
    var amountToPay = document.getElementById('paymentOverviewId');

    var amountForStage = document.getElementById('depositAmountId'); 

    window.onclick = function () {
        if (stage2.onclick) {
            // amountForStage.value = '$4999';
            selectedPlan.value = 'Stage 2';
            stage1.checked = false;
            stage2.checked = true;
            stage3.checked = false;
        }    
    }
    
    window.onchange = function () {
        if (selectedPlan.value == 'Stage 2') {
            // selectedPlan.value = 'Stage2';
            amountToPay.innerText = 'Overview payment: Amount to pay in is between \$5000 and above for premium plan';
        }
    }
}

function attachAmountStage3() {
    var stage1 = document.getElementById('checkStage1Id');
    var stage2 = document.getElementById('checkStage2Id');
    var stage3 = document.getElementById('checkStage3Id');

    var selectedPlan = document.getElementById('planId');

    var amountForStage = document.getElementById('depositAmountId'); 

    window.onclick = function () {
        if (stage3.onclick) {
            amountForStage.value = '$180';
            stage1.checked = false;
            stage2.checked = false;
            stage3.checked = true;
        }
    }

    window.onchange = function () {
        if (amountForStage.value == '$180') {
            selectedPlan.value = 'Stage3';
        }
    }
}

//  option on coin to transact with the following:
function transWithLiteCoin() {
    var litecoin = document.getElementById('liteId');

    var selectedMethod = document.getElementById('MethodId');

    window.onchange = function () {
        if (litecoin.onclick) {
            selectedMethod.value = 'Litecoin';
        }
    }
}

function transWithBitCoin() {
    var bitcoin = document.getElementById('btcId');

    var selectedMethod = document.getElementById('MethodId');

    window.onchange = function () {
        if (bitcoin.onclick) {
            selectedMethod.value = 'Bitcoin';
        }
    }
}

function transWithUsdt() {
    var usdt = document.getElementById('usId');

    var selectedMethod = document.getElementById('MethodId');

    window.onchange = function () {
        if (usdt.onclick) {
            selectedMethod.value = 'USDT';
        }
    }
}

function transWithEthereum() {
    var ethereum = document.getElementById('ethereumId');

    var selectedMethod = document.getElementById('MethodId');

    window.onchange = function () {
        if (ethereum.onclick) {
            selectedMethod.value = 'Ethereum';
        }
    }
}

function transWithBitcoinCash() {
    var ethereum = document.getElementById('btcCashId');

    var selectedMethod = document.getElementById('MethodId');

    window.onchange = function () {
        if (ethereum.onclick) {
            selectedMethod.value = 'Bitcoin Cash';
        }
    }
}

function valuesChanged() {
    var stageSelected = document.getElementById('planId');

    var elementToAdd = document.getElementById('selectValuesId');

    window.onchange = function (){
        if (stageSelected.value == 'Stage 1') {
            for (let index = 0; index <= 5000; index++) {
                elementToAdd.innerText = index;
            }
        }
    }
}