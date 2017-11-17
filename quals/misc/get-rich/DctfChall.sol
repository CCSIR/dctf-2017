pragma solidity ^0.4.4;

contract Owned {
    address public owner;

    function Owned() {
        owner = msg.sender;
    }

    modifier onlyOwner {
        require(msg.sender == owner);
        _;
    }

    function transferOwnership(address newOwner) onlyOwner {
        owner = newOwner;
    }
}

contract DctfChall is Owned {
	string public name;
	string public symbol;
	uint8 public decimals;

	mapping (address => uint256) public balanceOf;

	modifier onlyWithMoney(uint256 amount) {
		require(balanceOf[msg.sender]>= amount);
		_;
	}

	function DctfChall(uint256 _supply, string _name, string _symbol, uint8 _decimals) {
		if(_supply == 0) _supply = 13333337;

		balanceOf[msg.sender] = _supply;
		name                  = _name;
		symbol                = _symbol;
		decimals              = _decimals;
	}
		
	function invest(address to) payable {
		require(msg.value > 0);
		balanceOf[to] += msg.value;
		Transfer(msg.sender, to, msg.value);
	}
	
	function transferFrom(address to, uint256 amount) {
		require(amount > 0);
		require(balanceOf[msg.sender] >= amount);
		
		balanceOf[msg.sender] -= amount;
		balanceOf[to]         += amount;
		Transfer(msg.sender, to, amount);
	}

	function getBalance(address to) returns (uint256){
		return balanceOf[to];
	}

	function withdraw(uint256 amount) onlyWithMoney(amount) {
		require(amount > 0);
		msg.sender.call.value(amount)();
		balanceOf[msg.sender]-=amount;
		Withdraw(msg.sender, amount);
	}

	function getContractAddress() constant returns (address){
	    return this;
	}

	function() payable { }

	event Transfer(address indexed from, address indexed to, uint256 value);
	event Withdraw(address indexed to, uint256 value);
}
