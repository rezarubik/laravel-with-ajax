var amount = document.querySelectorAll("#dataReal").length;
var resLabels = [];
var resDatas = [];
var resMonths = [];
let consumseData = [];
let consumseLabel = [];
let consumseColor = [
    "#00f9ff",
    "#0a0909",
    "#90091e",
    "#f5a4a0",
    "#639daa",
    "#6666ff",
    "#d1f5c9",
    "#acce8f",
    "#7b9683",
];
var allData = [];
let consumseAllData = [];
for (var i = 0; i < amount; i++) {
    var details = document.getElementsByClassName("dataReal")[i].innerHTML;
    var obj = JSON.parse(details);
    resLabels.push(obj.kota);
    resDatas.push(parseInt(obj.nilai));
    resMonths.push(obj.bulan);
    allData.push({
        cities: resLabels[i],
        orders: resDatas[i],
        months: resMonths[i],
    });
}
const data = allData.reduce(
    (a, b) => {
        const i = a.months.findIndex((x) => x === b.months);
        const j = a.products.findIndex((y) => y.label === b.cities);
        if (i === -1) {
            a.months.push(b.months);
        }
        if (j === -1) {
            a.products.push({
                // backgroundColor: b.bgColor,
                // borderColor: "rgba(54, 162, 235, 1)",
                // borderWidth: 1,
                label: b.cities,
                data: [b.orders],
            });
        } else {
            a.products[j].data.push(b.orders);
        }
        return a;
    },
    { months: [], products: [] }
);

for(let i=0; i<data.products.length; i++){
    consumseData.push(data.products[i].data.reduce(tambah))
    consumseLabel.push(data.products[i].label)
};
for(let i=0; i<consumseLabel.length; i++)
{
    consumseAllData.push({
        label: consumseLabel[i],
        data: [consumseData[i]],
        backgroundColor: [consumseColor[i]],
        borderColor: "rgba(54, 162, 235, 1)",
        borderWidth: 1,
    });
}
var barChartData = {
    labels: data.months,
    datasets: consumseAllData
};
window.onload = function () {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: "bar",
        data: barChartData,
        options: {
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: "#c1c1c1",
                    borderSkipped: "bottom",
                },
            },
            responsive: true,
            title: {
                display: true,
                text: "Yearly User Joined",
            },
        },
    });
};

function tambah(total, num) {
    return total + num;
  }
