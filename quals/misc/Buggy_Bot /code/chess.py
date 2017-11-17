#/usr/bin/python2.7
column_reference = "a b c d e f g h".split(" ")
EMPTY_SQUARE = " "
 
class Model(object):
    def __init__(self):
        self.board = []
        pawn_base = "P "*8
        white_pieces =  "R N B Q K B N R"
        white_pawns = pawn_base.strip() 
        black_pieces = white_pieces.lower()
        black_pawns = white_pawns.lower()
        self.board.append(black_pieces.split(" "))
        self.board.append(black_pawns.split(" "))
        for i in range(4):
            self.board.append([EMPTY_SQUARE]*8)
        self.board.append(white_pawns.split(" "))
        self.board.append(white_pieces.split(" "))
 
    def move(self, start,  destination):
        for c in [start, destination]:
            if c.i > 7 or c.j > 7 or c.i <0 or c.j <0:
                return
        if start.i == destination.i and start.j == destination.j:
            return
 
        if self.board[start.i][start.j] == EMPTY_SQUARE:
            return
             
        f = self.board[start.i][start.j]
        self.board[destination.i][destination.j] = f
        self.board[start.i][start.j] = EMPTY_SQUARE
 
 
class BoardLocation(object):
    def __init__(self, i, j):
        self.i = i
        self.j = j
         
 
class View(object):
    def __init__(self):
        pass
    def display(self,  board):
        print("%s: %s"%(" ", column_reference))
        print("-"*50)
        for i, row in enumerate(board):
            row_marker = 8-i
            print("%s: %s"%(row_marker,  row))
         
 
class Controller(object):
    def __init__(self):
        self.model = Model()
        self.view = View()
     
    def run(self):
        ''' main loop'''
        print "/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\/\/\/\/"
        print "/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\/\/\/\/"
        print "DCTF{SHA256($positions)} , where $positions is a semicolon-separated list of board positions where the king can survive the first set of bot moves; the board positions must be sorted primarily by row number ascending, and secondarily by file letter alphabetically. Ex: DCTF{SHA256(a1;b1;c3...)}"
        print "/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\/\/\/\/"
        print "/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\/\/\/\/"
        while True:
            self.view.display(self.model.board)
            move = raw_input("move (eg e2-e4) ")
            move = move.lower()
            if move =="q":
                break
            if move =="":
                move = "e2-e4"
            start,  destination = self.parse_move(move)
            self.model.move(start, destination)
            start,  destination = self.parse_move("a2-b2")
            self.model.move(start, destination)
            start,  destination = self.parse_move("b2-c2")
            self.model.move(start, destination)
            start,  destination = self.parse_move("c2-d2")
            self.model.move(start, destination)
            start,  destination = self.parse_move("e2-f2")
            self.model.move(start, destination)
            start,  destination = self.parse_move("f2-g2")
            self.model.move(start, destination)
            start,  destination = self.parse_move("g2-h2")
            self.model.move(start, destination)
            start,  destination = self.parse_move("h2-a1")
            self.model.move(start, destination)
            start,  destination = self.parse_move("a1-b1")
            self.model.move(start, destination)
            start,  destination = self.parse_move("b1-c1")
            self.model.move(start, destination)
            start,  destination = self.parse_move("c1-d1")
            self.model.move(start, destination)
            start,  destination = self.parse_move("e1-f1")
            self.model.move(start, destination)
            start,  destination = self.parse_move("f1-g1")
            self.model.move(start, destination)
            start,  destination = self.parse_move("g1-h1")
            self.model.move(start, destination)
            start,  destination = self.parse_move("h1-a3")
            self.model.move(start, destination)
            start,  destination = self.parse_move("a3-b3")
            self.model.move(start, destination)
            start,  destination = self.parse_move("b3-c3")
            self.model.move(start, destination)
            start,  destination = self.parse_move("c3-d3")
            self.model.move(start, destination)
            start,  destination = self.parse_move("e3-f3")
            self.model.move(start, destination)
            start,  destination = self.parse_move("f3-g3")
            self.model.move(start, destination)
            start,  destination = self.parse_move("g3-h3")
            self.model.move(start, destination)
            start,  destination = self.parse_move("h3-a4")
            self.model.move(start, destination)
            start,  destination = self.parse_move("a4-b4")
            self.model.move(start, destination)
            start,  destination = self.parse_move("b4-c4")
            self.model.move(start, destination)
            start,  destination = self.parse_move("c4-d4")
            self.model.move(start, destination)
            start,  destination = self.parse_move("e4-f4")
            self.model.move(start, destination)
            start,  destination = self.parse_move("f4-g4")
            self.model.move(start, destination)
            start,  destination = self.parse_move("g4-h4")
            self.model.move(start, destination)
            start,  destination = self.parse_move("h4-a5")
            self.model.move(start, destination)
            start,  destination = self.parse_move("a5-b5")
            self.model.move(start, destination)
            start,  destination = self.parse_move("b5-c5")
            self.model.move(start, destination)
            start,  destination = self.parse_move("c5-d5")
            self.model.move(start, destination)
            start,  destination = self.parse_move("e5-f5")
            self.model.move(start, destination)
            start,  destination = self.parse_move("f5-g5")
            self.model.move(start, destination)
            start,  destination = self.parse_move("g5-h5")
            self.model.move(start, destination)
            start,  destination = self.parse_move("h5-a6")
            self.model.move(start, destination)
            start,  destination = self.parse_move("a6-b6")
            self.model.move(start, destination)
            start,  destination = self.parse_move("b6-c6")
            self.model.move(start, destination)
            start,  destination = self.parse_move("c6-d6")
            self.model.move(start, destination)
            start,  destination = self.parse_move("e6-f6")
            self.model.move(start, destination)
            start,  destination = self.parse_move("f6-g6")
            self.model.move(start, destination)
            start,  destination = self.parse_move("g6-h6")
            self.model.move(start, destination)
            start,  destination = self.parse_move("h6-a7")
            self.model.move(start, destination)
            start,  destination = self.parse_move("a7-b7")
            self.model.move(start, destination)
            start,  destination = self.parse_move("b7-c7")
            self.model.move(start, destination)
            start,  destination = self.parse_move("c7-d7")
            self.model.move(start, destination)
            start,  destination = self.parse_move("e7-f7")
            self.model.move(start, destination)
            start,  destination = self.parse_move("f7-g7")
            self.model.move(start, destination)
            start,  destination = self.parse_move("g7-h7")
            self.model.move(start, destination)


    def parse_move(self, move):
         
        s, d = move.split("-")
        i = 8- int(s[-1])
        j = column_reference.index(s[0])
        start = BoardLocation(i, j)
         
        i =  8- int(d[-1])
        j= column_reference.index(d[0])
        destination = BoardLocation(i, j)
 
        return start,  destination
         
 
if __name__=="__main__":
    C = Controller()
    C.run()
