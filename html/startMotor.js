const express = require('express');
const Gpio = require('onoff').Gpio;

const app = express();
const gpioPin1 = 17;
const gpioPin2 = 18;
const gpioPin3 = 27;
const gpioPin4 = 22;

const sequence = [
    [0, 0, 0, 1],
    [0, 0, 1, 0],
    [0, 1, 0, 0],
    [1, 0, 0, 0]
];

const gpio1 = new Gpio(gpioPin1, 'out');
const gpio2 = new Gpio(gpioPin2, 'out');
const gpio3 = new Gpio(gpioPin3, 'out');
const gpio4 = new Gpio(gpioPin4, 'out');

const steps = 4096*10;
const delay = 15;

let stepInterval;

function rotateStepperMotor() {
    let i = 0;

    stepInterval = setInterval(() => {
        const step = i % 4;
        const gpioValues = sequence[step];

        gpio1.writeSync(gpioValues[0]);
        gpio2.writeSync(gpioValues[1]);
        gpio3.writeSync(gpioValues[2]);
        gpio4.writeSync(gpioValues[3]);

        i++;

        if (i >= steps) {
            clearInterval(stepInterval);
            gpio1.writeSync(0);
            gpio2.writeSync(0);
            gpio3.writeSync(0);
            gpio4.writeSync(0);
            gpio1.unexport();
            gpio2.unexport();
            gpio3.unexport();
            gpio4.unexport();
        }
    }, delay);
}

app.get('/startMotor', (req, res) => {
    if (!stepInterval) {
        rotateStepperMotor();
        res.send('Motor started.');
    } else {
        res.send('Motor is already running.');
    }
});

app.listen(3000, () => {
    console.log('Server is running on port 3000');
});
