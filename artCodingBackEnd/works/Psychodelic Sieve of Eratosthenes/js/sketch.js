var numbersChecked;
var blockSize = 5;
var maxN;
var curN;
var curM;
var fillSaturation = 0.3;

function setup() {
  createCanvas(windowWidth, windowHeight); 
//  createCanvas(200, 200); 
  noSmooth();
  noStroke();
  colorMode(HSB, 1.0);
  rectMode(CORNER);
  maxN = Math.floor(width/blockSize) * Math.floor(height/blockSize);
  restart();
} 

function restart() {
  background(255);
  curN = 0;
  numbersChecked = new Array(maxN);
  numbersChecked[0] = true;
  numbersChecked[1] = true;
  for (var i = 2; i < maxN; i++) {
    numbersChecked[i] = false;
  }
  nextN();
}

function drawPoint(n) {
  var x = (n-1) % Math.floor(width/blockSize);
  var y = Math.floor((n-1) / Math.floor(width/blockSize));
//  point(x, y);
  rect(x*blockSize, y*blockSize, blockSize, blockSize);
}

function nextN() {
  while(numbersChecked[curN]) {
    curN++;
    if (curN >= maxN) {
      restart();
    }
  }
  fill(255);
  numbersChecked[curN] = true;
  drawPoint(curN);
  curM = 2*curN;
  fill(color(random(1), fillSaturation, 1));  
}

function nextM() {
  drawPoint(curM);
  numbersChecked[curM] = true;
  curM += curN;
}

function draw() {
  if (curM > maxN) {
    nextN();
  } else {
    for (var i = 0; i < maxN/curN/100 && curM <= maxN; i++) {
      nextM(); 
    }
  }
}