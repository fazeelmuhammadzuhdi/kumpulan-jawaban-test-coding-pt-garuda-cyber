// soal no 1
function formSmallestNumber(sequence) {
  const availableDigits = new Set([1, 2, 3, 4, 5, 6, 7, 8, 9]);
  const number = [];
  let currentDigit = 9;

  for (const char of sequence) {
    if (char === "M") {
      number.push(currentDigit);
      availableDigits.delete(currentDigit);
      currentDigit--;
      number.push(currentDigit);
      availableDigits.delete(currentDigit);
      currentDigit--;
    } else {
      number.push(currentDigit);
      availableDigits.delete(currentDigit);
      currentDigit--;
    }
  }

  return parseInt(number.join(""), 10);
}

console.log(formSmallestNumber("M"));
console.log(formSmallestNumber("N"));
console.log(formSmallestNumber("MM"));
console.log(formSmallestNumber("NN"));
console.log(formSmallestNumber("MNMN"));
console.log(formSmallestNumber("NNMMM"));
console.log(formSmallestNumber("MMNMMNNM"));

// soal no 2
function findFewestBottles(bottleCapacities, totalWater) {
  bottleCapacities.sort((a, b) => b - a);

  const bottles = [];
  let remainingWater = totalWater;

  for (const capacity of bottleCapacities) {
    const count = Math.floor(remainingWater / capacity);
    bottles.push({ capacity, count });
    remainingWater -= count * capacity;
  }

  let output = "Answer:\n";
  let totalBottles = 0;

  for (const bottle of bottles) {
    output += `Bottle ${bottle.capacity} = ${bottle.count} bottles, `;
    totalBottles += bottle.count;
  }

  output += `total = ${totalBottles} bottles`;

  return output;
}

const bottleCapacities = [5, 7, 11];
const totalWater = 100;
const result = findFewestBottles(bottleCapacities, totalWater);
console.log(result);
