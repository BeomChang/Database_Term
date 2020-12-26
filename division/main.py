import csv

f = open('data.csv', 'r', encoding='utf-8')
rdr = csv.reader(f)

customer = []
cattr = ['name', 'phone', 'address', 'gender']
customer.append(cattr)

transaction = []
tattr = ['transactionNumber', 'productID', 'price', 'date', 'customerName'];
transaction.append(tattr)

product = []
pattr = ['name', 'productID', 'supplierName']
product.append(pattr)

for line in rdr:
    temp = []
    if (line[0] == 'C'):
        temp.append(line[1].strip())
        temp.append(line[2].strip())
        temp.append(line[3].strip())
        temp.append(line[4].strip())
        customer.append(temp)

    elif (line[0] == 'T'):
        temp.append(line[1].strip())
        temp.append(line[2].strip())

        pstr = line[3].strip().split("$")
        temp.append(pstr[1])

        dlist = line[4].strip().split('/')
        dstr = dlist[2] + '-' + dlist[1] + '-' + dlist[0]
        temp.append(dstr)

        temp.append(line[5].strip())
        transaction.append(temp)

    elif (line[0] == 'P'):
        temp.append(line[1].strip())
        temp.append(line[2].strip())
        temp.append(line[3].strip())
        product.append(temp)

f.close()

f = open('customer.csv', 'w', newline='')
wr = csv.writer(f)
for row in customer:
    wr.writerow(row)
f.close()

f = open('product.csv', 'w', newline='')
wr = csv.writer(f)
for row in product:
    wr.writerow(row)
f.close()

f = open('transaction.csv', 'w', newline='')
wr = csv.writer(f)
for row in transaction:
    wr.writerow(row)
f.close()